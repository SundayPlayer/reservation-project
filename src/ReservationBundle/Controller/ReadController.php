<?php

namespace ReservationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReadController extends Controller
{
    /**
     * @Route("/reservations")
     * @Method({"GET"})
     */
    public function reservationsAction()
    {
        $repo = $this->getDoctrine()->getRepository('ReservationBundle:Reservations');
        
        $reservations = $repo->findAll();

        $tbl = array();
        foreach ( $reservations AS $val ) {
            $tbl[] = array(
                "id" => $val->getId(),
                "time" => array(
                    "start" => $val->getStartTime(),
                    "end" => $val->getEndTime()
                ),
                "user" => array(
                    "id" => $val->getUsers()->getId(),
                    "firstName" => $val->getUsers()->getFirstName(),
                    "lastName" => $val->getUsers()->getLastName(),
                    "accessType" => $val->getUsers()->getAccessType(),
                    "email" => $val->getUsers()->getEmail(),
                    "phoneNumber" => $val->getUsers()->getPhoneNumber()
                ),
                "class" => array(
                    "id" => $val->getClasses()->getId(),
                    "name" => $val->getClasses()->getName()
                ),
                "classroom" => array(
                    "id" => $val->getClassrooms()->getId(),
                    "name" => $val->getClassrooms()->getName()
                ),
                "lesson" => array(
                    "id" => $val->getLessons()->getId(),
                    "name" => $val->getLessons()->getName()
                )
            );
        }

        $response = new JsonResponse();
        $response->setData($tbl);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
    
    /**
     * @Route("/users")
     * @Method({"GET"})
     */
    public function usersAction()
    {
        $repo = $this->getDoctrine()->getRepository('ReservationBundle:Users');
        
        $users = $repo->createQueryBuilder('q')
           ->getQuery()
           ->getArrayResult();
        
        $response = new JsonResponse();
        $response->setData($users);
        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
    
    /**
     * @Route("/classes")
     * @Method({"GET"})
     */
    public function classesAction()
    {
        $repo = $this->getDoctrine()->getRepository('ReservationBundle:Classes');
        
        $classes = $repo->createQueryBuilder('q')
           ->getQuery()
           ->getArrayResult();
        
        $response = new JsonResponse();
        $response->setData($classes);
        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
    
    /**
     * @Route("/lessons")
     * @Method({"GET"})
     */
    public function lessonsAction()
    {
        $repo = $this->getDoctrine()->getRepository('ReservationBundle:Lessons');
        
        $lessons = $repo->createQueryBuilder('q')
           ->getQuery()
           ->getArrayResult();
        
        $response = new JsonResponse();
        $response->setData($lessons);
        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
    
    /**
     * @Route("/classrooms")
     * @Method({"GET"})
     */
    public function classroomsAction()
    {
        $repo = $this->getDoctrine()->getRepository('ReservationBundle:Classrooms');
        
        $classrooms = $repo->createQueryBuilder('q')
           ->getQuery()
           ->getArrayResult();
        
        $response = new JsonResponse();
        $response->setData($classrooms);
        
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
}