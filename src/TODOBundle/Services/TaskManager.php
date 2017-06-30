<?php

namespace TODOBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\DateTime;

class TaskManager
{
    private $repoTask;
    private $repoUser;
    private $otherServices;
    private $em;

    public function __construct(EntityManager $em, OtherServices $otherServices)
    {
        $this->repoTask = $em->getRepository('TODOBundle:Task');
        $this->repoUser = $em->getRepository('TODOBundle:User');
        $this->otherServices = $otherServices;
        $this->em = $em;
    }

    public function getAllTasks()
    {
        return $this->repoTask->findAll();

    }

    public function createTask($name, $id_executor)
    {
        $executor = $this->repoUser->find($id_executor);

        if($executor) {
            $task = $executor->createNewTask($name);
            $errorsLog = $this->otherServices->validator($task);
            if ($errorsLog) {
                return ['success' => false, 'errorsLog' => $errorsLog];
            } else {
                $this->em->flush();
                return ['success' => true, 'errorsLog' => false];
            }
        }else{
            return 'User not found!';
        }
    }

    public function editTask($id_task, $name, $acceptionDate, $executionDate, $status)
    {
        $actual_task = $this->repoTask->find($id_task);

        if($actual_task) {

            if($name) {
                $actual_task->setName($name);
            }
            if($acceptionDate) {
                $actual_task->setAcceptionDate(new \DateTime($acceptionDate));
            }
            if($executionDate) {
                $actual_task->setExecutionDate(new \DateTime($executionDate));
            }
            if($status) {
                $actual_task->setStatus(true);
            }else{
                $actual_task->setStatus(false);
            }

            $errorsLog = $this->otherServices->validator($actual_task);
            if ($errorsLog) {
                return ['success' => false, 'errorsLog' => $errorsLog];
            } else {
                $this->repoTask->saverObject($actual_task);
                return ['success' => true, 'errorsLog' => false];
            }
        }else{
            return 'Task not found!';
        }

    }

    public function deleteTask($id_task)
    {
        $actual_task = $this->repoTask->find($id_task);

        if($actual_task){
            $this->repoTask->removeObject($actual_task);
            return 'Task removed';
        }else{
            return 'Task not found';
        }
    }
}