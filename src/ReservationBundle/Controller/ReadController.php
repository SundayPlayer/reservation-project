<?php

namespace ReservationBundle\Controller;

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
        
        $reservations = $repo->createQueryBuilder('q')
            ->getQuery()
            ->getArrayResult();
        
        $response = new JsonResponse();
        $response->setData($reservations);
        
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