<?php


namespace App\Controller;


use App\Entity\Employee;
use App\Form\employee\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Employee as EmployeeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

const EMPLOYEE_CREATE = 'employee/create.html.twig';
const EMPLOYEE_LIST = 'employee/list.html.twig';

/** @Route("/employee") */
class EmployeeController extends AbstractController
{
    private $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    /** @Route("/create")
     * @param Request $request
     */
    public function createAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            try {
                $this->persistObject($employee);
            } catch (\Exception $e) {
                return $e;
            }
            return $this->redirect('create');
        }

        return $this->render(EMPLOYEE_CREATE, [
           'form' => $form->createView(),
            'deneme' => $this->employeeService->getHappyMessage()
        ]);
    }
    /** @Route("/list") */
    public function listAction() {
        try {
            $employees = $this->getDoctrine()->getRepository(Employee::class)->findAll();
        } catch (\Exception $e) {
            return $e;
        }

        return $this->render(EMPLOYEE_LIST, [
            'employees' => $employees
        ]);
    }

    protected function persistObject($employee) {
        $em = $this->getDoctrine()->getManager();
        try {
            $em->persist($employee);
            $em->flush();
        } catch (\Exception $e) {
            return $e;
        }

    }
}