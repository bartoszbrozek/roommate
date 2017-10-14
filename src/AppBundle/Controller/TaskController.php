<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Task;

class  TaskController extends Controller
{

    /**
     * @Route("/task/{id}", name="task")
     */
    public function indexAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getRepository(Task::class)
            ->getSingleTaskById($id);

        return $this->render('task/task.html.twig', [
            'task' => $task
        ]);
    }

}
