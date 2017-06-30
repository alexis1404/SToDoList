<?php

namespace TODOBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * @Route("/get_all_users", name="get_all_users")
     * @Method("GET")
     */
    public function getAllUsersAction()
    {
        $all_users = $this->get('user_manager')->getAllUsers();

        $result = ['users' => []];

        $row = 0;

        foreach($all_users as $value) {
            $result['users'][$row] = [
                'id' => $value->getId(),
                'user_name' => $value->getName(),
            ];

            $row++;
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/create_user", name="create_user")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "user_name": "test_person"
    }
    */
    public function createNewUserAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $user_data = json_decode($content, true);

        return new JsonResponse($this->get('user_manager')->createNewUser($user_data['user_name']));
    }

    /**
     * @Route("/edit_user", name="edit_user")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "id": 1
    "user_name": "test_person"
    }
    */
    public function editUserAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $user_data = json_decode($content, true);

        return new JsonResponse($this->get('user_manager')->editUser($user_data['id'], $user_data['user_name']));
    }

    /**
     * @Route("/delete_user", name="delete_user")
     * @Method("POST")
     */

    /*
    Valid JSON:

    {
    "id": 1
    }
    */
    public function deleteUserAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $user_data = json_decode($content, true);

        return new JsonResponse($this->get('user_manager')->deleteUser($user_data['id']));
    }
}