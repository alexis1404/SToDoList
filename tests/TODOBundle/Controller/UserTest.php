<?php

namespace tests\TODOBundle\Controller;


use TODOBundle\Entity\User;
use TODOBundle\Entity\Task;


class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUserCreate()
    {
        $user = new User('name');

        $this->assertEquals(null, $user->getId());
        $this->assertEquals('name', $user->getName());

    }

    public function testUserTasksAddAndRemove()
    {
        $user = new User('name');
        $task = new Task('name');

        $this->assertEmpty($user->getTasks());

        $user->addTask($task);

        $this->assertNotEmpty($user->getTasks());

        $user->removeTask($task);

        $this->assertEmpty($user->getTasks());
    }
}
