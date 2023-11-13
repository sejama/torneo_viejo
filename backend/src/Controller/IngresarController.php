<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
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
    #[Route('/login', name: 'app_login', methods: ["POST"])]
    public function login(
        //AuthenticationUtils $authenticationUtils
        //#[CurrentUser] ?User $user //#[CurrentUser] $user = null
        UserInterface $user,
        JWTTokenManagerInterface $JWTManager
    ): JsonResponse
    {
        //$requestBody = json_decode($request->getContent(), true);
        //$user = $this->getUser();

        // get the login error if there is one
        //$error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        //$lastUsername = $authenticationUtils->getLastUsername();

        //if (null === $user) {
        //    return $this->json([
        //        'message' => 'missing credentials',
        //    ], Response::HTTP_UNAUTHORIZED);
        //}
        //$token = "..."; // somehow create an API token for $user
        return $this->json([
            ['token' => $JWTManager->create($user)]
        ]);
    }
}