<?php

namespace TODOBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends Controller
{
    /**
     * @Route("/get_all_users", name="get_all_users")
     * @Method("GET")
     */
    public function getAllUsersAction()
    {
        return new JsonResponse('HELLO SHURIK!');
    }
}