<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\Inscripcion;
use App\Entity\Torneo;
use App\Repository\InscripcionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[OA\Tag(name: 'Insripciones')]
#[Route("/api", "api_", format: "json")]
class InscripcionController extends AbstractController
{
    #[OA\Response(
        response: 200,
        description: 'Retorna todos los Inscripciones',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Inscripcion::class))
        )
    )]
    #[Route('/inscripcion', name: 'get_inscripciones', methods: ["GET"])]
    public function getInscripciones(InscripcionRepository $tr): JsonResponse
    {
        $inscripciones = $tr->findAll();

        if(count($inscripciones) == 0) {
            return $this->json([Response::HTTP_NO_CONTENT, "No se encontraron inscripciones"]);
        }else{
            return $this->json($inscripciones, Response::HTTP_OK, [], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id', 
                    'torneo' => [
                        'id', 
                        'nombre'
                    ], 
                    'equipo' => [
                        'id', 
                        'nombre'
                    ],
                    'createdAt',
                    'updatedAt',
                    'habilitado']
            ]);
        }
    }

    #[OA\Response(
        response: 200,
        description: 'Retorna un Inscripcion',
        content: new OA\JsonContent(
            ref: new Model(type: Inscripcion::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Inscripcion',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route('/inscripcion/{id}', name: 'get_inscripcion', methods: ["GET"])]
    public function getInscripcion(Inscripcion $inscripcion): JsonResponse
    {
        if ($inscripcion) {
            return $this->json($inscripcion, Response::HTTP_OK, [], [
                ObjectNormalizer::ATTRIBUTES => [
                    'id', 
                    'torneo' => [
                        'id', 
                        'nombre'
                    ], 
                    'equipo' => [
                        'id', 
                        'nombre'
                    ],
                    'createdAt',
                    'updatedAt',
                    'habilitado']
            ]);
        }else{
            return $this->json(Response::HTTP_NOT_FOUND);
        }
    }

    #[OA\Response(
        response: 201,
        description: 'Retorna el Inscripcion creado',
        content: new OA\JsonContent(
            ref: new Model(type: Inscripcion::class)
        )
    )]
    //#[OA\RequestBody(new Model(type: Inscripcion::class, groups: ["create"]))]
    #[OA\RequestBody(
        description: 'Datos del Inscripcion',
        required: true,
        content: new Model(type: Inscripcion::class, groups: ["create"])
        
    )]
    #[Route("/inscripcion", name:'create_inscripcion', methods: ["POST"])]
    public function createInscripcion(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        $inscripcion = new Inscripcion();

        if(isset($requestBody['torneo']))
            $inscripcion->setTorneo($em->getRepository(Torneo::class)->find((int)$requestBody['torneo']));

        if(isset($requestBody['equipo']))
            $inscripcion->setEquipo($em->getRepository(Equipo::class)->find((int)$requestBody['equipo']));
        
        if(isset($requestBody['habilitado'])){
            $inscripcion->setHabilitado($requestBody['habilitado']);
        }else{
            $inscripcion->setHabilitado(false);
        }
        
        $errores = $validator->validate($inscripcion);
        if (count($errores) > 0) {
            return $this->json([Response::HTTP_BAD_REQUEST, $errores]);
        }

        $em->persist($inscripcion);
        $em->flush();

        return $this->json($inscripcion, Response::HTTP_CREATED, [], [
            ObjectNormalizer::ATTRIBUTES => [
                'id', 
                'torneo' => [
                    'id', 
                    'nombre'
                ], 
                'equipo' => [
                    'id', 
                    'nombre'
                ],
                'createdAt',
                'updatedAt',
                'habilitado']
        ]);
    }

    #[OA\Response(
        response: 202,
        description: 'Retorna el Inscripcion actualizado',
        content: new OA\JsonContent(
            ref: new Model(type: Inscripcion::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Inscripcion a actualizar',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Inscripcion::class, groups: ["update"])
        )
    )]
    #[Route("/inscripcion/{id}", name:'update_inscripcion', methods: ["PUT"])]
    public function updateInscripcion(
        Inscripcion $inscripcion,
        Request $request,
        EntityManagerInterface $em
        ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        if(isset($requestBody['torneo']))
            $inscripcion->setTorneo($em->getRepository(Torneo::class)->find((int)$requestBody['torneo']));
        
        if(isset($requestBody['equipo']))
            $inscripcion->setEquipo($em->getRepository(Equipo::class)->find((int)$requestBody['equipo']));

        if(isset($requestBody['habilitado'])){
            $inscripcion->setHabilitado($requestBody['habilitado']);
        }else{
            $inscripcion->setHabilitado(false);
        }

        $em->persist($inscripcion);
        $em->flush();

        return $this->json($inscripcion, Response::HTTP_CREATED, [], [
            ObjectNormalizer::ATTRIBUTES => [
                'id', 
                'torneo' => [
                    'id', 
                    'nombre'
                ], 
                'equipo' => [
                    'id', 
                    'nombre'
                ],
                'createdAt',
                'updatedAt',
                'habilitado']
        ]);
    }

    #[OA\Response(
        response: 204,
        description: 'Retorna un 204 si la Inscripcion fue eliminado'
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Inscripcion',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route("/inscripcion/{id}", name:'delete_inscripcion', methods: ["DELETE"])]
    public function deleteInscripcion(
        Inscripcion $inscripcion,
        EntityManagerInterface $em): JsonResponse
    {
        $em->remove($inscripcion);
        $em->flush();

        return $this->json([Response::HTTP_NO_CONTENT, "Inscripción eliminado"]);
    }

}
