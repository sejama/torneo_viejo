<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[OA\Tag(name: 'Ingresar')]
#[Route("/api", "api_", format: "json")]
class IngresarController extends AbstractController
{
    #[OA\Response(
        response: 201,
        description: 'Retorna el Usuario creado',
        content: new OA\JsonContent(
            ref: new Model(type: User::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Usaurio',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: User::class, groups: ["ingresar"])
        )
    )]
    #[Route('/ingresar', name: 'app_ingresar', methods: ["POST"])]
    public function ingresar(
        #[CurrentUser] ?User $user
    ): JsonResponse
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $token = "..."; // somehow create an API token for $user
        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}