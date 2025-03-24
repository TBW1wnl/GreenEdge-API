<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class AuthController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->json([
                'message' => 'Email and password are required',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Find the user by email
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        
        if (!$user) {
            // User does not exist, let's be explicit about it
            return $this->json([
                'message' => 'Login failed. Please check that you have registered and that your email and password are correct.',
                'debug' => 'User not found in database'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        // Verify password
        if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
            return $this->json([
                'message' => 'Login failed. Please check that you have registered and that your email and password are correct.',
                'debug' => 'Invalid password'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        // Generate a simple token
        $token = $this->generateToken($user);
        
        return $this->json([
            'user' => $user->getEmail(),
            'token' => $token,
        ]);
    }

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->json([
                'message' => 'Email and password are required',
            ], Response::HTTP_BAD_REQUEST);
        }
        
        // Check if user already exists
        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existingUser) {
            return $this->json([
                'message' => 'User with this email already exists',
            ], Response::HTTP_CONFLICT);
        }
        
        try {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setPassword(
                $passwordHasher->hashPassword($user, $data['password'])
            );
            $user->setRoles(['ROLE_USER']);
            
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->json([
                'message' => 'User registered successfully',
                'email' => $user->getEmail()
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    private function generateToken(User $user): string
    {
        $payload = [
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'iat' => time(),
            'exp' => time() + (3600 * 24) // Token valid for 24 hours
        ];
        
        return base64_encode(json_encode($payload)) . '.' . hash_hmac('sha256', json_encode($payload), $this->getParameter('kernel.secret'));
    }
}