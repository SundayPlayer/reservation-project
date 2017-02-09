<?php

namespace ReservationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ReservationBundle\Entity\Reservations;
use ReservationBundle\Entity\Classrooms;
use ReservationBundle\Entity\Classes;
use ReservationBundle\Entity\Lessons;
use ReservationBundle\Entity\Users;

class AddController extends Controller
{
    /**
     * @Route("/reservations/add")
     * @Method({"POST"})
     */
    public function reservationsAction(Request $request)
    {
        $data = $request->request->get('reservation');
        
        $em = $this->getDoctrine()->getManager();
        
        $reservation = new Reservations();
        
        $reservation->setStartTime($data["time"]["start"])
                    ->setEndTime($data["time"]["end"])
                    ->setClasses($data["class"])
                    ->setClassrooms($data["classroom"])
                    ->setLessons($data["lesson"])
                    ->setUsers($data["user"]);

        $em->persist($reservation);

        $em->flush();
        
        
        return new Response();
    }
    
    /**
     * @Route("/users/add")
     * @Method({"POST"})
     */
    public function usersAction(Request $request)
    {
        $data = $request->request->get('user');
        
        $em = $this->getDoctrine()->getManager();
        
        $user = new Users();
        $user->setAccessType($data["accessType"])
                ->setEmail($data["email"])
                ->setFirstName($data["firstName"])
                ->setLastName($data["lastName"])
                ->setPhoneNumber($data["phoneNumber"])
                ->setPassword($data["password"]);
        
        $em->persist($user);
        
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/classes/add")
     * @Method({"POST"})
     */
    public function classesAction(Request $request)
    {
        $data = $request->request->get('class');
        
        $em = $this->getDoctrine()->getManager();
        
        $class = new Classes();
        $class->setName($data["name"]);
        
        $em->persist($class);
        
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/lessons/add")
     * @Method({"POST"})
     */
    public function lessonsAction(Request $request)
    {
        $data = $request->request->get('lesson');
        
        $em = $this->getDoctrine()->getManager();
        
        $lesson = new Lessons();
        
        $lesson->setName($data["name"]);
        
        $em->persist($lesson);
        
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/classrooms/add")
     * @Method({"POST"})
     */
    public function classroomsAction(Request $request)
    {
        $data = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        
        $classroom = new Classrooms();
        $classroom->setName($data["name"]);
        
        $em->persist($classroom);
        
        $em->flush();
        
        return new Response();
    }
}