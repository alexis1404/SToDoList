<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.07.17
 * Time: 14:55
 */

namespace tests\TODOBundle\Controller;

use TODOBundle\Services\UserManager;
use TODOBundle\Entity\User;
use TODOBundle\Entity\Task;


class UserManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAllUser()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));

        $mockers['repo']->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue([$user = new User('name')]));

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals([$user], $userManager->getAllUsers());
    }

    public function testCreateNewUserSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['repo']->expects($this->once())
            ->method('saverObject');

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $userManager->createNewUser('name'));
    }

    public function testCreateNewUserFailureObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['otherServices']->expects($this->once())
            ->method('validator')->will($this->returnValue(true));

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $userManager->createNewUser('name'));
    }

    public function testEditUserSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user = new User('name')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator');
        $mockers['repo']->expects($this->once())
            ->method('saverObject');

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => true, 'errorsLog' => false], $userManager->editUser('idUser', 'username'));

    }

    public function testEditUserFailureObject()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user = new User('name')));
        $mockers['otherServices']->expects($this->once())
            ->method('validator')->will($this->returnValue(true));

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(['success' => false, 'errorsLog' => true], $userManager->editUser('idUser', 'username'));
    }

    public function testEditUserNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('User not found!', $userManager->editUser('idUser', 'username'));
    }

    public function testDeleteUserSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user = new User('name')));
        $mockers['repo']->expects($this->once())
            ->method('removeObject');

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals(true, $userManager->deleteUser('idUser'));
    }

    public function testDeleteUserNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('User not found!', $userManager->deleteUser('idUser'));
    }

    public function testGetUserTasksSuccess()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user = new User('name')));
        $user = new User('name');
        $tasks = $user->getTasks();

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals($tasks, $userManager->getUserTasks('idUser'));
    }

    public function testGetUserTasksUserNotFound()
    {
        $mockers = $this->getMockers();

        $mockers['em']->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($mockers['repo']));
        $mockers['repo']->expects($this->once())
            ->method('find')
            ->will($this->returnValue(false));

        $userManager = new UserManager($mockers['em'], $mockers['otherServices']);

        $this->assertEquals('User not found!', $userManager->getUserTasks('idUser'));
    }

    //service method. returned mokers
    public function getMockers()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()->getMock();
        $otherServices = $this->getMockBuilder('TODOBundle\Services\OtherServices')
            ->disableOriginalConstructor()->getMock();
        $repo = $this->getMockBuilder('TODOBundle\Repository\UserRepository')
            ->disableOriginalConstructor()->getMock();

        return $mockers = [
            'otherServices' => $otherServices,
            'em' => $em,
            'repo' => $repo
        ];
    }
}
