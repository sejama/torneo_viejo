<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Repository\GeneroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[OA\Tag(name: 'Generos')]
#[Route("/api", "api_", format: "json")]
class GeneroController extends AbstractController
{
    #[OA\Response(
        response: 200,
        description: 'Retorna todos los Generos',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Genero::class))
        )
    )]
    #[Route('/genero', name: 'app_genero', methods: ["GET"])]
    public function getGeneros(GeneroRepository $gr): Response
    {
        $generos = $gr->findAll();

        if (count($generos) == 0) {
            return $this->json([Response::HTTP_NO_CONTENT, "No se encontraron generos"]);
        } else {
            return $this->json($generos, Response::HTTP_OK,[], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id',
                    'nombre'
                ]]);
        }
    }

    #[OA\Response(
        response: 200,
        description: 'Retorna un Genero',
        content: new OA\JsonContent(
            ref: new Model(type: Genero::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Genero',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route('/genero/{id}', name: 'get_genero', methods: ["GET"])]
    public function getGenero(Genero $genero): JsonResponse
    {
        try{
            return $this->json($genero, Response::HTTP_OK,[], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id', 
                    'nombre'
                ]
            ]);
        }
        catch(\Exception $e){
                //return $this->json([Response::HTTP_NOT_FOUND, "No se encontró el genero"]);
                throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[OA\Response(
        response: 201,
        description: 'Retorna el Genero creado',
        content: new OA\JsonContent(
            ref: new Model(type: Genero::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Genero',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Genero::class, groups: ["create"])
        )
    )]
    #[Route("/genero", name:'create_genero', methods: ["POST"])]
    public function creategenero(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        $genero = new Genero();
        $genero->setNombre($requestBody['nombre']);

        $errores = $validator->validate($genero);
        if (count($errores) > 0) {
            return $this->json([Response::HTTP_BAD_REQUEST, $errores]);
        }

        $em->persist($genero);
        $em->flush();

        return $this->json([Response::HTTP_CREATED, $genero]);
    }

    #[OA\Response(
        response: 202,
        description: 'Retorna el Genero actualizada',
        content: new OA\JsonContent(
            ref: new Model(type: Genero::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Genero a actualizar',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Genero::class, groups: ["update"])
        )
    )]
    #[Route("/genero/{id}", name:'update_genero', methods: ["PUT"])]
    public function updateGenero(
        Genero $genero,
        Request $request,
        EntityManagerInterface $em
        ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        if(isset($requestBody['nombre']))
        {
            $genero->setNombre($requestBody['nombre']);
        }
        
        $em->persist($genero);
        $em->flush();

        return $this->json([Response::HTTP_ACCEPTED, $genero]);
    }

    #[OA\Response(
        response: 204,
        description: 'Retorna un 204 si el Genero fue eliminado'
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Genero',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route("/genero/{id}", name:'delete_genero', methods: ["DELETE"])]
    public function deleteGenero(
        Genero $genero,
        EntityManagerInterface $em): JsonResponse
    {
        $em->remove($genero);
        $em->flush();

        return $this->json([Response::HTTP_NO_CONTENT, "Genero eliminado"]);
    }
}
