<?php

namespace App\Controller;

use App\Entity\Torneo;
use App\Repository\TorneoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[OA\Tag(name: 'Torneos')]
#[Route("/api", "api_", format: "json")]
class TorneoController extends AbstractController
{
    #[OA\Response(
        response: 200,
        description: 'Retorna todos los Torneos',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Torneo::class))
        )
    )]
    #[Route('/torneo', name: 'get_torneos', methods: ["GET"])]
    public function getTorneos(TorneoRepository $tr): JsonResponse
    {
        $torneos = $tr->findAll();

        if(count($torneos) == 0) {
            return $this->json([Response::HTTP_NO_CONTENT, "No se encontraron torneos"]);
        }else{
            return $this->json([Response::HTTP_OK, $torneos]);
        }
    }

    #[OA\Response(
        response: 200,
        description: 'Retorna un Torneo',
        content: new OA\JsonContent(
            ref: new Model(type: Torneo::class)
        )
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Torneo',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route('/torneo/{id}', name: 'get_torneo', methods: ["GET"])]
    public function getTorneo(Torneo $torneo): JsonResponse
    {
        try{
            return $this->json([Response::HTTP_OK, $torneo]);
        }
        catch(\Exception $e){
                //return $this->json([Response::HTTP_NOT_FOUND, "No se encontró el torneo"]);
                throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[OA\Response(
        response: 201,
        description: 'Retorna el Torneo creado',
        content: new OA\JsonContent(
            ref: new Model(type: Torneo::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Torneo',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Torneo::class, groups: ["create"])
        )
    )]
    #[Route("/torneo", name:'create_torneo', methods: ["POST"])]
    public function createTorneo(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        $torneo = new Torneo();
        $torneo->setNombre($requestBody['nombre']);
        $torneo->setFechaInicio(new \DateTimeImmutable($requestBody['fechaInicio']));
        $torneo->setFechaFin(new \DateTimeImmutable($requestBody['fechaFin']));
        $torneo->setFechaInicioInscripcion(new \DateTimeImmutable($requestBody['fechaInicioInscripcion']));
        $torneo->setFechaFinInscripcion(new \DateTimeImmutable($requestBody['fechaFinInscripcion']));
        
        $errores = $validator->validate($torneo);
        if (count($errores) > 0) {
            return $this->json([Response::HTTP_BAD_REQUEST, $errores]);
        }

        $em->persist($torneo);
        $em->flush();

        return $this->json([Response::HTTP_CREATED, $torneo]);
    }

    #[OA\Response(
        response: 202,
        description: 'Retorna el Torneo actualizado',
        content: new OA\JsonContent(
            ref: new Model(type: Torneo::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Datos del Torneo a actualizar',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Torneo::class, groups: ["update"])
        )
    )]
    #[Route("/torneo/{id}", name:'update_torneo', methods: ["PUT"])]
    public function updateTorneo(
        Torneo $torneo,
        Request $request,
        EntityManagerInterface $em
        ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        if(isset($requestBody['nombre']))
        {
            $torneo->setNombre($requestBody['nombre']);
        }
        if(isset($requestBody['fechaInicio']))
        {
            $torneo->setFechaInicio(new \DateTimeImmutable($requestBody['fechaInicio']));
        }
        if(isset($requestBody['fechaFin']))
        {
            $torneo->setFechaFin(new \DateTimeImmutable($requestBody['fechaFin']));
        }
        if(isset($requestBody['fechaInicioInscripcion']))
        {
            $torneo->setFechaInicioInscripcion(new \DateTimeImmutable($requestBody['fechaInicioInscripcion']));
        }
        if(isset($requestBody['fechaFinInscripcion']))
        {
            $torneo->setFechaFinInscripcion(new \DateTimeImmutable($requestBody['fechaFinInscripcion']));
        }

        $em->persist($torneo);
        $em->flush();

        return $this->json([Response::HTTP_ACCEPTED, $torneo]);
    }

    #[OA\Response(
        response: 204,
        description: 'Retorna un 204 si el torneo fue eliminado'
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'ID del Torneo',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[Route("/torneo/{id}", name:'delete_torneo', methods: ["DELETE"])]
    public function deleteTorneo(
        Torneo $torneo,
        EntityManagerInterface $em): JsonResponse
    {
        $em->remove($torneo);
        $em->flush();

        return $this->json([Response::HTTP_NO_CONTENT, "Torneo eliminado"]);
    }

}
