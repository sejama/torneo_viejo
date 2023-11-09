<?php 

namespace App\Controller;

use App\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[OA\Tag(name: 'Registracion')]
#[Route("/api", "api_", format: "json")]
class RegistracionController extends AbstractController
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
            ref: new Model(type: User::class, groups: ["create"])
        )
    )]

    #[Route("/registrar", name:'create_user', methods: ["POST"])]
    public function createUser(
        UserPasswordHasherInterface $passwordHasher,
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        
        $user = new User();
        $plaintextPassword = $requestBody['password'];
        $user->setUsername($requestBody['username']);
        $user->setRoles($requestBody['roles']);

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new JsonResponse($errorsString, Response::HTTP_BAD_REQUEST, [], true);
        }

        $em->persist($user);
        $em->flush();

        return $this->json([Response::HTTP_CREATED, $user]);
    }
}