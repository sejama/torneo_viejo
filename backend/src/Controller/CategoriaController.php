<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
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

#[OA\Tag(name: 'Categorias')]
#[Route("/api", "api_", format: "json")]
class CategoriaController extends AbstractController
{
    #[OA\Response(
        response: 200,
        description: 'Retorna todos los Categorias',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Categoria::class))
        )
    )]
    #[Route('/categoria', name: 'app_categoria', methods: ["GET"])]
    public function getCategorias(CategoriaRepository $cr): Response
    {
        $categorias = $cr->findAll();

        if(count($categorias) == 0) {
            return $this->json([Response::HTTP_NO_CONTENT, "No se encontraron categorias"]);
        }else{
            return $this->json($categorias, Response::HTTP_OK,[], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id',
                    'nombre'
                ]]);
        }
    }

    #[OA\Response(
        response: 200,
        description: 'Retorna un Categoria',
        content: new OA\JsonContent(
            ref: new Model(type: Categoria::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Categoria',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route('/categoria/{id}', name: 'get_categoria', methods: ["GET"])]
    public function getCategoria(Categoria $categoria): JsonResponse
    {
        try{
            return $this->json($categoria, Response::HTTP_OK,[], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id', 
                    'nombre'
                ]
            ]);
        }
        catch(\Exception $e){
                //return $this->json([Response::HTTP_NOT_FOUND, "No se encontró el categoria"]);
                throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[OA\Response(
        response: 201,
        description: 'Retorna la Categoria creada',
        content: new OA\JsonContent(
            ref: new Model(type: Categoria::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Categoria',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Categoria::class, groups: ["create"])
        )
    )]
    #[Route("/categoria", name:'create_categoria', methods: ["POST"])]
    public function createCategoria(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        $categoria = new Categoria();
        $categoria->setNombre($requestBody['nombre']);

        $errores = $validator->validate($categoria);
        if (count($errores) > 0) {
            return $this->json([Response::HTTP_BAD_REQUEST, $errores]);
        }

        $em->persist($categoria);
        $em->flush();

        return $this->json([Response::HTTP_CREATED, $categoria]);
    }

    #[OA\Response(
        response: 202,
        description: 'Retorna el Categoria actualizada',
        content: new OA\JsonContent(
            ref: new Model(type: Categoria::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Categoria a actualizar',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Categoria::class, groups: ["update"])
        )
    )]
    #[Route("/categoria/{id}", name:'update_categoria', methods: ["PUT"])]
    public function updateCategoria(
        Categoria $categoria,
        Request $request,
        EntityManagerInterface $em
        ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        if(isset($requestBody['nombre']))
        {
            $categoria->setNombre($requestBody['nombre']);
        }
        
        $em->persist($categoria);
        $em->flush();

        return $this->json([Response::HTTP_ACCEPTED, $categoria]);
    }

    #[OA\Response(
        response: 204,
        description: 'Retorna un 204 si el Categoria fue eliminado'
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Categoria',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route("/categoria/{id}", name:'delete_categoria', methods: ["DELETE"])]
    public function deleteCategoria(
        Categoria $categoria,
        EntityManagerInterface $em): JsonResponse
    {
        $em->remove($categoria);
        $em->flush();

        return $this->json([Response::HTTP_NO_CONTENT, "Categoria eliminado"]);
    }
}
