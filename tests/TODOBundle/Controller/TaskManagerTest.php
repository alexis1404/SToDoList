<?php

namespace tests\TODOBundle\Controller;


use TODOBundle\Services\TaskManager;
use TODOBundle\Entity\User;
use TODOBundle\Entity\Task;


class TaskManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAllTasks()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue([$tasks = new Task('name')]));

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals([$tasks], $taskManager->getAllTasks());
    }

    public function testCreateTaskSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoUser']));

        $mockers['repoUser']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user = new User('name')));

        $user->createNewTask('name');

        $mockers['otherServices']->expects($this->once())
            ->method('validator');

        $mockers['em']->expects($this->any())
            ->method('flush');

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $taskManager->createTask('name', 'id_executor'));
    }

    public function testCreateTaskInvalidObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoUser']));

        $mockers['repoUser']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user = new User('name')));

        $user->createNewTask('name');

        $mockers['otherServices']->expects($this->once())
            ->method('validator')
            ->will($this->returnValue(true));

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $taskManager->createTask('name', 'id_executor'));
    }

    public function testCreateTaskExecutorNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoUser']));

        $mockers['repoUser']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('User not found!', $taskManager->createTask('name', 'id_executor'));
    }

    public function testEditTaskSuccessFullEdition()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($tasks = new Task('name')));

        $mockers['otherServices']->expects($this->once())
            ->method('validator');

        $mockers['repoTask']->expects($this->once())
            ->method('saverObject');

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $taskManager->editTask('id_task', 'name', '2017-06-22', '2017-06-22', 'status'));
    }

    public function testEditTaskSuccessStatusFalse()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($tasks = new Task('name')));

        $mockers['otherServices']->expects($this->once())
            ->method('validator');

        $mockers['repoTask']->expects($this->once())
            ->method('saverObject');

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $taskManager->editTask('id_task', 'name', '2017-06-22', '2017-06-22', false));
    }

    public function testEditTaskInvalidObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($tasks = new Task('name')));

        $mockers['otherServices']->expects($this->once())
            ->method('validator')
            ->will($this->returnValue(true));

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $taskManager->editTask('id_task', 'name', '2017-06-22', '2017-06-22', 'status'));
    }

    public function testEditTaskNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('Task not found!', $taskManager->editTask('id_task', 'name', '2017-06-22', '2017-06-22', 'status'));
    }

    public function testDeleteTaskSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($tasks = new Task('name')));

        $mockers['repoTask']->expects($this->once())
            ->method('removeObject');

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('Task removed', $taskManager->deleteTask('id_task'));
    }

    public function testDeleteTaskNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repoTask']));

        $mockers['repoTask']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $taskManager = new TaskManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('Task not found', $taskManager->deleteTask('id_task'));
    }

    //service method. returned mokers
    public function getMockers()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()->getMock();
        $otherServices = $this->getMockBuilder('TODOBundle\Services\OtherServices')
            ->disableOriginalConstructor()->getMock();
        $repoTask = $this->getMockBuilder('TODOBundle\Repository\TaskRepository')
            ->disableOriginalConstructor()->getMock();
        $repoUser = $this->getMockBuilder('TODOBundle\Repository\UserRepository')
            ->disableOriginalConstructor()->getMock();

        return $mockers = [
            'otherServices' => $otherServices,
            'em' => $em,
            'repoTask' => $repoTask,
            'repoUser' => $repoUser
        ];
    }


}
