<?php

namespace tests\TODOBundle\Controller;


use TODOBundle\Entity\Task;
use TODOBundle\Entity\User;


class TaskTest extends \PHPUnit_Framework_TestCase
{
    public function testTaskCreate()
    {
        $task = new Task('name');

        $this->assertEquals(null, $task->getId());
        $this->assertEquals('name', $task->getName());
        $this->assertEquals(date_format(new \DateTime('now'), 'Y-m-d H:i:s'), $task->getAcceptionDate());
        $this->assertEquals(null, $task->getExecutionDate());
        $task->setExecutionDate(new \DateTime('now'));
        $this->assertEquals(date_format(new \DateTime('now'), 'Y-m-d H:i:s'), $task->getExecutionDate());
        $this->assertEquals(false, $task->getStatus());
        $task->setStatus(true);
        $this->assertEquals(true, $task->getStatus());
    }

    public function testTaskAddAndRemoveExecutor()
    {
        $task = new Task('name');
        $executor = new User('name');

        $this->assertEmpty($task->getExecutor());

        $task->setExecutor($executor);

        $this->assertNotEmpty($task->getExecutor());
    }
}
