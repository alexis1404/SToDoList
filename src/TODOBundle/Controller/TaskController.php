<?php

namespace TODOBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints\Date;

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
                'status' => $value->getStatus(),
                'executor' => $value->getExecutor()->getName()
            ];

            $row++;
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/create_task/{id_executor}", name="create_task")
     * @Method("POST")
     */
    /*
    Valid JSON:

    {
    "name": "name_task"
    }
    */
    public function createTaskAction(Request $request, $id_executor)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $taskData = json_decode($content, true);

        return new JsonResponse($this->get('task_manager')->createTask($taskData['name'], $id_executor));
    }

    /**
     * @Route("/edit_task", name="edit_task")
     * @Method("POST")
     */
    /*
    Valid JSON:

 {
 "id": 1,
 "name": "Новая Задача",
 "acceptionDate": "20010-10-10",
 "executionDate": "2017-07-27",
 "status": 0  (1 or 0; 1 - complete, 0- incomplete)
 }
  The quantity of fields may be any
    */
    public function editTaskAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $taskData = json_decode($content, true);

        return  new JsonResponse($this->get('task_manager')->editTask(
            $taskData['id'],
            isset($taskData['name']) ? $taskData['name'] : null,
            isset($taskData['acceptionDate']) ? $taskData['acceptionDate'] : null,
            isset($taskData['executionDate']) ? $taskData['executionDate'] : null,
            isset($taskData['status']) ? $taskData['status'] : null
        ));
    }

     /**
      * @Route("/delete_task", name="delete_task")
      * @Method("POST")
      */
     /*
      Valid JSON:

 {
 "id": 1 (this task will be destroyed)
 }
      */
    public function deleteTaskAction(Request $request)
    {
        $content = $request->getContent();

        if(empty($content)){

            throw new HttpException(400, 'Incorrect request!');
        }

        $taskData = json_decode($content, true);

        return new JsonResponse($this->get('task_manager')->deleteTask($taskData['id']));
    }
}