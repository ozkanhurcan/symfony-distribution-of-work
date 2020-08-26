<?php


namespace App\Controller;

use App\Entity\Employee;
use App\Service\WorksGlobalProvider;
use App\Service\WorksProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

const WORK_LIST = 'works/list.html.twig';

/** @Route("/works") */
class WorksController extends AbstractController
{
    /** @Route("/list") */
    public function listAction() {
        $workLists = (new WorksProvider())->toArray();
        try {
            $developers = $this->getDoctrine()->getRepository(Employee::class)->getUserForWorkload();
        } catch (\Exception $e){
            return $e;
        }

        try {
            $weeklyReport = $this->createWeeklyReport($workLists, $developers);
        } catch (\Exception $e) {
            return $e;
        }


        return $this->render(WORK_LIST, [
            'weeklyReport' => $weeklyReport
        ]);
    }

    public function createWeeklyReport($workLists, $developers) {
        $weeklyReport = [];
        while (!(empty($workLists))) {
            $developerWorks = [];
            foreach ($developers as $developer) {
                $developerWorks[$developer['id']] = $developer;
            }
            foreach ($workLists as $key => $workList) {
                foreach ($developers as $developer) {
                    if ($developerWorks[$developer['id']]['weeklyWorkLoad'] >= $workList['required_load']) {
                        $developerWorks[$developer['id']]['weeklyWorkLoad'] -= $workList['required_load'];
                        $developerWorks[$developer['id']]['works'][] = $workList;
                        unset($workLists[$key]);
                        break;
                    }
                }
            }
            $weeklyReport[] = $developerWorks;
        }
        return $weeklyReport;
    }
}