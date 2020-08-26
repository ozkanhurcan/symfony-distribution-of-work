<?php


namespace App\Controller;

use App\Entity\Works;
use App\Form\GetWorkList\GetWorkListType;
use App\Service\WorksGlobalProvider;
use App\Service\WorksProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** @Route("/get-works-controller") */

const GET_WORK_LIST_TEMPLATE = 'get-work-list/create.html.twig';
/** @Route("/get-work-list") */
class GetWorksController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     * @Route("/create")
     */
    public function createAction() {
        $worksData = (new WorksGlobalProvider())->toArray();
        $em = $this->getDoctrine()->getManager();
        foreach ($worksData as $workData) {
            $workEntity = $this->createWorkEntity($workData);
            try {
                $em->persist($workEntity);
                $em->flush();
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render(GET_WORK_LIST_TEMPLATE, [
            'error' => $error ?? ''
        ]);
    }

    public function createWorkEntity($workData) {
        $workEntity = new Works();
        $workEntity->setEstimatedDuration($workData['estimated_duration'])
            ->setTitle($workData['title'])
            ->setLevel($workData['level']);

        return $workEntity;
    }

}