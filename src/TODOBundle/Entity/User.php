<?php

namespace TODOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TODOBundle\Entity\Task;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="TODOBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="TODOBundle\Entity\Task", mappedBy="executor", cascade={"persist", "remove"})
     */
    private $tasks;

    public function __construct($name)
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->name = $name;

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * Add task
     *
     * @param \TODOBundle\Entity\Task $task
     *
     * @return User
     */
    public function addTask(\TODOBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \TODOBundle\Entity\Task $task
     */
    public function removeTask(\TODOBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    public function createNewTask($name)
    {
        $task = new Task($name);

        $task->setExecutor($this);

        $this->addTask($task);

        return $task;
    }
}
