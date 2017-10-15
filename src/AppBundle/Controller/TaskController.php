<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class  TaskController extends Controller
{

    /**
     * @Route("/task/show/{id}", name="task")
     */
    public function indexAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getRepository(Task::class)
            ->getSingleTaskById($id);

        if (is_null($task)) {
            $request->getSession()->getFlashBag()->add('error', "Could not find task of id = $id");
            return $this->redirectToRoute('index');
        }

        return $this->render('task/task.html.twig', [
            'task' => $task
        ]);
    }

    /**
     * @Route("/task/create", name="taskCreate")
     */
    public function createAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success','Task added successfully');
            return $this->redirectToRoute('index');
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
