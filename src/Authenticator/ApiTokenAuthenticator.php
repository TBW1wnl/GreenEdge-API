<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class ApiTokenAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    private $entityManager;
    private $params;

    public function __construct(EntityManagerInterface $entityManager, ParameterBagInterface $params)
    {
        $this->entityManager = $entityManager;
        $this->params = $params;
    }

    public function start(Request $request, ?\Throwable $authException = null): Response
    {
        return new Response(json_encode(['message' => 'Authentication Required']), Response::HTTP_UNAUTHORIZED, ['Content-Type' => 'application/json']);
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('Authorization')
            && str_starts_with($request->headers->get('Authorization'), 'Bearer ');
    }

    public function authenticate(Request $request): Passport
    {
        $authorizationHeader = $request->headers->get('Authorization');
        $apiToken = substr($authorizationHeader, 7);
        
        if (null === $apiToken) {
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }
        
        // Validate the token
        $tokenParts = explode('.', $apiToken);
        if (count($tokenParts) !== 2) {
            throw new CustomUserMessageAuthenticationException('Invalid token format');
        }
        
        $payload = json_decode(base64_decode($tokenParts[0]), true);
        if (!$payload || !isset($payload['email']) || !isset($payload['exp'])) {
            throw new CustomUserMessageAuthenticationException('Invalid token payload');
        }
        
        // Check expiration
        if ($payload['exp'] < time()) {
            throw new CustomUserMessageAuthenticationException('Token has expired');
        }
        
        // Verify signature
        $expectedSignature = hash_hmac('sha256', json_encode($payload), $this->params->get('app.api_token_secret'));
        if (!hash_equals($expectedSignature, $tokenParts[1])) {
            throw new CustomUserMessageAuthenticationException('Invalid token signature');
        }
        
        return new SelfValidatingPassport(
            new UserBadge($payload['email'], function($userIdentifier) {
                return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $userIdentifier]);
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}