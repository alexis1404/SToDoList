<?php

namespace TODOBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TaskController extends Controller
{
    /**
     * @Route("/get_all_tasks", name="get_all_tasks")
     * @Method("GET")
     */
    public function getAllTasksAction()
    {
        $allTasks = $this->get('task_manager')->getAllTasks();

        $result = ['tasks' => []];

        $row = 0;

        foreach($allTasks as $value)
        {
            $result['tasks'][$row] = [
                'id' => $value->getId(),
                'name' => $value->getName(),
                'acceptionDate' => $value->getAcceptionDate(),
                'executionDate' => $value->getExecutionDate(),
                'status' => $value->getStatus()
            ];

            $row++;
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/create_task", name="create_task")
     * @Method("POST")
     */
    /*
    Valid JSON:

    {
    "name": "name_task",
    "executor_id": 2 (executor`s ID)
    }
    */
    public function createTaskAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $task_data = json_decode($content, true);

        return new JsonResponse($this->get('task_manager')->createTask($task_data['name'], $task_data['executor_id']));
    }
}