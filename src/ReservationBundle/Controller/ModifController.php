<?php

namespace ReservationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModifController extends Controller
{
    /**
     * @Route("/reservations/update")
     * @Method({"POST"})
     */
    public function reservationsAction(Request $request)
    {
        $data = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('ReservationBundle:Reservations')->findOneBy($data["id"]);

        if (!$reservation) {
            throw $this->createNotFoundException(
                'No product found for id '.$data["id"]
            );
        }
        
        $reservation->setStartTime($data["startTime"])
                    ->setEndTime($data["endTime"])
                    ->setClasses($data["class"])
                    ->setClassrooms($data["classroom"])
                    ->setLessons($data["lesson"])
                    ->setUsers($data["user"]);
        $em->flush();
    
        return new Response();
    }
    
    /**
     * @Route("/users/update")
     * @Method({"POST"})
     */
    public function usersAction(Request $request)
    {
        $data = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ReservationBundle:Users')->find($data["id"]);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$data["id"]
            );
        }
        
        $user->setAccessType($data["accessType"])
                ->setEmail($data["email"])
                ->setFirstName($data["firstName"])
                ->setLastName($data["lastName"])
                ->setPhoneNumber($data["phoneNumber"])
                ->setPassword($data["password"]);
        
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/classes/update")
     * @Method({"POST"})
     */
    public function classesAction(Request $request)
    {
        $data = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        $class = $em->getRepository('ReservationBundle:Classes')->find($data["id"]);

        if (!$class) {
            throw $this->createNotFoundException(
                'No product found for id '.$data["id"]
            );
        }
        
        $class->setName($data["name"]);
        
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/lessons/update")
     * @Method({"POST"})
     */
    public function lessonsAction(Request $request)
    {
        $data = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->getRepository('ReservationBundle:Lessons')->find($data["id"]);

        if (!$lesson) {
            throw $this->createNotFoundException(
                'No product found for id '.$data["id"]
            );
        }
        
        $lesson->setName($data["name"]);
        
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/classrooms/update")
     * @Method({"POST"})
     */
    public function classroomsAction(Request $request)
    {
        $data = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository('ReservationBundle:Classrooms')->find($data["id"]);

        if (!$classroom) {
            throw $this->createNotFoundException(
                'No product found for id '.$data["id"]
            );
        }
        
        $classroom->setName($data["name"]);
        
        $em->flush();
        
        return new Response();
    }
}
