<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class  TaskController extends Controller
{

    /**
     * @Route("/task/show/{id}", name="task")
     */
    public function indexAction(Request $request, $id): Response
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
    public function createAction(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Task added successfully');
            return $this->redirectToRoute('index');
        }

        return $this->render('task/createOrEdit.html.twig', [
            'pageHeader' => 'Create Task',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/task/edit/{id}", name="taskUpdate")
     */
    public function editAction(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $request->getSession()->getFlashBag()->add('success', 'Task updated successfully');
            return $this->redirectToRoute('taskUpdate', ['id' => $task->getId()]);
        }

        return $this->render('task/createOrEdit.html.twig', [
            'pageHeader' => 'Edit Task',
            'task' => $task,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/task/delete/{id}", name="taskDelete")
     */
    public function deleteAction(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();

            $em->remove($task);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Task removed successfully');
            return $this->redirectToRoute('index');


    }
}
