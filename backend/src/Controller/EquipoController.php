<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Repository\EquipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[OA\Tag(name: 'Equipos')]
#[Route("/api", "api_", format: "json")]
class EquipoController extends AbstractController
{
    #[OA\Response(
        response: 200,
        description: 'Retorna todos los Equipos',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Equipo::class))
        )
    )]
    #[Route('/equipo', name: 'get_equipos', methods: ["GET"])]
    public function getEquipos(EquipoRepository $tr): JsonResponse
    {
        $equipos = $tr->findAll();

        if(count($equipos) == 0) {
            return $this->json([Response::HTTP_NO_CONTENT, "No se encontraron Equipos"]);
        }else{
            return $this->json($equipos, Response::HTTP_OK,[], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id', 
                    'nombre',
                    'observacion',
                    'createdAt',
                    'updatedAt',
                    'inscripcion' => [
                        'id',
                        'habilitado',
                        'torneo' => [
                            'id',
                            'nombre',
                            'fechaInicio',
                            'fechaFin',
                            'observacion',
                            'createdAt',
                            'updatedAt'
                        ]
                    ]
                ]
            ]);
        }
    }

    #[OA\Response(
        response: 200,
        description: 'Retorna un Equipo',
        content: new OA\JsonContent(
            ref: new Model(type: Equipo::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Equipo',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route('/equipo/{id}', name: 'get_equipo', methods: ["GET"])]
    public function getEquipo(Equipo $equipo): JsonResponse
    {
        try{
            return $this->json($equipo, Response::HTTP_OK,[], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id', 
                    'nombre',
                    'observacion',
                    'createdAt',
                    'updatedAt',
                    'inscripcion' => [
                        'id',
                        'habilitado',
                        'torneo' => [
                            'id',
                            'nombre',
                            'fechaInicio',
                            'fechaFin',
                            'observacion',
                            'createdAt',
                            'updatedAt'
                        ]
                    ]
                ]
            ]);
        }
        catch(\Exception $e){
                //return $this->json([Response::HTTP_NOT_FOUND, "No se encontró el Equipo"]);
                throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[OA\Response(
        response: 201,
        description: 'Retorna el Equipo creado',
        content: new OA\JsonContent(
            ref: new Model(type: Equipo::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Equipo',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Equipo::class, groups: ["create"])
        )
    )]
    #[Route("/equipo", name:'create_equipo', methods: ["POST"])]
    public function createEquipo(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        $equipo = new Equipo();

        $equipo->setNombre($requestBody['nombre']);
        $equipo->setObservacion($requestBody['observacion']);

        $errores = $validator->validate($equipo);
        if (count($errores) > 0) {
            return $this->json([Response::HTTP_BAD_REQUEST, $errores]);
        }

        $em->persist($equipo);
        $em->flush();

        return $this->json([Response::HTTP_CREATED, $equipo]);
    }

    #[OA\Response(
        response: 202,
        description: 'Retorna el Equipo actualizado',
        content: new OA\JsonContent(
            ref: new Model(type: Equipo::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Equipo a actualizar',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Equipo::class, groups: ["update"])
        )
    )]
    #[Route("/equipo/{id}", name:'update_equipo', methods: ["PUT"])]
    public function updateEquipo(
        Equipo $equipo,
        Request $request,
        EntityManagerInterface $em
        ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        if(isset($requestBody['nombre']))
            $equipo->setNombre($requestBody['nombre']);
        
        if(isset($requestBody['observacion']))
            $equipo->setObservacion($requestBody['observacion']);


        $em->persist($equipo);
        $em->flush();

        return $this->json([Response::HTTP_ACCEPTED, $equipo]);
    }

    #[OA\Response(
        response: 204,
        description: 'Retorna un 204 si la Equipo fue eliminado'
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Equipo',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route("/equipo/{id}", name:'delete_equipo', methods: ["DELETE"])]
    public function deleteEquipo(
        Equipo $equipo,
        EntityManagerInterface $em): JsonResponse
    {
        $em->remove($equipo);
        $em->flush();

        return $this->json([Response::HTTP_NO_CONTENT, "Inscripción eliminado"]);
    }

}
