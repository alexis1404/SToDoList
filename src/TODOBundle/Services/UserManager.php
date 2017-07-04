<?php

namespace TODOBundle\Services;

use Doctrine\ORM\EntityManager;
use TODOBundle\Entity\User;

class UserManager
{
    private $repoUser;
    private $otherServices;

    public function __construct(EntityManager $em, OtherServices $otherServices)
    {
        $this->repoUser = $em->getRepository('TODOBundle:User');
        $this->otherServices = $otherServices;

    }

    public function getAllUsers()
    {
        return $this->repoUser->findAll();
    }

    public function createNewUser($name)
    {
        $newUser = new User($name);
        $errorsLog = $this->otherServices->validator($newUser);

        if($errorsLog){
            return ['success' => false, 'errorsLog' => $errorsLog];
        }else{
            $this->repoUser->saverObject($newUser);
            return['success' => true, 'errorsLog' => false];
        }
    }

    public function editUser($idUser, $name)
    {
        $actual_user = $this->repoUser->find($idUser);

        if($actual_user) {
            $actual_user->setName($name);
            $errorsLog = $this->otherServices->validator($actual_user);
            if ($errorsLog) {
                return ['success' => false, 'errorsLog' => $errorsLog];
            } else {
                $this->repoUser->saverObject($actual_user);
                return ['success' => true, 'errorsLog' => false];
            }
        }else{
            return 'User not found!';
        }
    }

    public function deleteUser($idUser)
    {
        $actual_user = $this->repoUser->find($idUser);
        if($actual_user){
            $this->repoUser->removeObject($actual_user);
            return true;
        }else{
            return 'User not found!';
        }
    }

    public function getUserTasks($idUser)
    {
        $actual_user = $this->repoUser->find($idUser);

        if($actual_user){
            return $actual_user->getTasks();
        }else{
            return false;
        }
    }
}