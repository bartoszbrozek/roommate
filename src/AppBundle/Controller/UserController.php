<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{

    /**
     * @Route("/user/show/{id}", name="user")
     */
    public function indexAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)
            ->getSingleUserById($id);
        return $this->render('user/user.html.twig', [
            'user' => $user
        ]);
    }

}
