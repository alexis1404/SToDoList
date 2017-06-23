<?php

namespace TODOBundle\Services;

use Doctrine\ORM\EntityManager;
use TODOBundle\Entity\Task;

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
}