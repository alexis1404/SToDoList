<?php

namespace TODOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="TODOBundle\Repository\TaskRepository")
 */
class Task
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
     * @var \DateTime
     *
     * @ORM\Column(name="acceptionDate", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("datetime")
     */
    private $acceptionDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="executionDate", type="datetime", nullable=true)
     * @Assert\Type("datetime")
     */
    private $executionDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     * @Assert\Type("boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="TODOBundle\Entity\User", inversedBy="tasks", cascade={"persist"})
     * @ORM\JoinColumn(name="executor", referencedColumnName="id")
     */
    private $executor;

    public function __construct($name)
    {
        $this->name = $name;
        $this->acceptionDate = new \DateTime('now');
        $this->status = false;
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
     * @return Task
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
     * Set acceptionDate
     *
     * @param \DateTime $acceptionDate
     *
     * @return Task
     */
    public function setAcceptionDate($acceptionDate)
    {
        $this->acceptionDate = $acceptionDate;

        return $this;
    }

    /**
     * Get acceptionDate
     *
     * @return \DateTime
     */
    public function getAcceptionDate()
    {
        return date_format($this->acceptionDate, 'Y-m-d H:i:s');
    }

    /**
     * Set executionDate
     *
     * @param \DateTime $executionDate
     *
     * @return Task
     */
    public function setExecutionDate($executionDate)
    {
        $this->executionDate = $executionDate;

        return $this;
    }

    /**
     * Get executionDate
     *
     * @return \DateTime
     */
    public function getExecutionDate()
    {
        if($this->executionDate){
            return date_format($this->executionDate, 'Y-m-d H:i:s');
        }else{
            return null;
        }

    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set executor
     *
     * @param \TODOBundle\Entity\User $executor
     *
     * @return Task
     */
    public function setExecutor(\TODOBundle\Entity\User $executor = null)
    {
        $this->executor = $executor;

        return $this;
    }

    /**
     * Get executor
     *
     * @return \TODOBundle\Entity\User
     */
    public function getExecutor()
    {
        return $this->executor;
    }
}
