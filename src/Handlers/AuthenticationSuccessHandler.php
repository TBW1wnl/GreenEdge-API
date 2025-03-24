<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use App\Entity\User;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $tokenGenerator;

    public function __construct(private string $apiTokenSecret)
    {
        $this->apiTokenSecret = $apiTokenSecret;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $user = $token->getUser();
        
        // Generate API token
        $apiToken = $this->generateApiToken($user);
        
        return new JsonResponse([
            'user' => $user->getEmail(),
            'token' => $apiToken,
        ]);
    }
    
    private function generateApiToken(User $user): string
    {
        $payload = [
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'iat' => time(),
            'exp' => time() + (3600 * 24) // Token valid for 24 hours
        ];
        
        return base64_encode(json_encode($payload)) . '.' . hash_hmac('sha256', json_encode($payload), $this->apiTokenSecret);
    }
}

class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        return new JsonResponse([
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}