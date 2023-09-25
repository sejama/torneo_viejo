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

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
            $encoder = new JsonEncoder();
            $defaultContext = [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $object, string $format, array $context): int {
                return $object->getId();
                },
            ];
            $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

            $serializer = new Serializer([$normalizer], [$encoder]);
            return $this->json([Response::HTTP_OK, $serializer->serialize($inscripciones, 'json')]);
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
        try{
            return $this->json([Response::HTTP_OK, $inscripcion]);
        }
        catch(\Exception $e){
                //return $this->json([Response::HTTP_NOT_FOUND, "No se encontró la inscripción"]);
                throw new BadRequestHttpException($e->getMessage());
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

        return $this->json([Response::HTTP_CREATED, $inscripcion]);
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
            $inscripcion->setTorneo($requestBody['torneo']);
        
        if(isset($requestBody['equipo']))
            $inscripcion->setEquipo($requestBody['equipo']);

        if(isset($requestBody['habilitado']))
            $inscripcion->setHabilitado($requestBody['habilitado']);

        $em->persist($inscripcion);
        $em->flush();

        return $this->json([Response::HTTP_ACCEPTED, $inscripcion]);
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
