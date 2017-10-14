<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Task;

class MainController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
    $tasks = $this->getDoctrine()->getRepository(Task::class)
        ->getTasks();

        return $this->render('default/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

}
