<?php

namespace ReservationBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\ReservationsRepository")
 */
class Reservations
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
     * @var DateTime
     *
     * @ORM\Column(name="start_time", type="date")
     */
    private $startTime;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="end_time", type="date")
     */
    private $endTime;

    /**
     * @ORM\ManyToOne(targetEntity="Users")
     */
    private $users;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lessons")
     */
    private $lessons;

    /**
     * @ORM\ManyToOne(targetEntity="Classes")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity="Classrooms")
     */
    private $classrooms;

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
     * Set startTime
     *
     * @param DateTime $startTime
     *
     * @return Reservations
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param DateTime $endTime
     *
     * @return Reservations
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set users
     *
     * @param Users $users
     *
     * @return Reservations
     */
    public function setUsers(Users $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return Users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set lessons
     *
     * @param Lessons $lessons
     *
     * @return Reservations
     */
    public function setLessons(Lessons $lessons = null)
    {
        $this->lessons = $lessons;

        return $this;
    }

    /**
     * Get lessons
     *
     * @return Lessons
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * Set classes
     *
     * @param Classes $classes
     *
     * @return Reservations
     */
    public function setClasses(Classes $classes = null)
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Get classes
     *
     * @return Classes
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Set classrooms
     *
     * @param Classrooms $classrooms
     *
     * @return Reservations
     */
    public function setClassrooms(Classrooms $classrooms = null)
    {
        $this->classrooms = $classrooms;

        return $this;
    }

    /**
     * Get classrooms
     *
     * @return Classrooms
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }
}
