<?php

namespace ReservationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DeleteController extends Controller
{
    /**
     * @Route("/reservations/delete")
     * @Method({"POST"})
     */
    public function reservationsAction(Request $request)
    {
        $reservationRequest = $request->request->get('reservation');
        
        $em = $this->getDoctrine()->getManager();
        
        $reservation = $em->getRepository('ReservationBundle:Reservations')->find($reservationRequest);

        if (!$reservation) {
            throw $this->createNotFoundException(
                'No product found for id '.$reservation["id"]
            );
        }
        
        $em->remove($reservation);
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/users/delete")
     * @Method({"POST"})
     */
    public function usersAction(Request $request)
    {
        $userRequest = $request->request->get('user');
        
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('ReservationBundle:Users')->find($userRequest);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$user["id"]
            );
        }
        
        $em->remove($user);
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/classes/delete")
     * @Method({"POST"})
     */
    public function classesAction(Request $request)
    {
        $classRequest = $request->request->get('class');
        
        $em = $this->getDoctrine()->getManager();
        
        $class = $em->getRepository('ReservationBundle:Classes')->find($classRequest);

        if (!$class) {
            throw $this->createNotFoundException(
                'No product found for id '.$class["id"]
            );
        }
        
        $em->remove($class);
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/lessons/delete")
     * @Method({"POST"})
     */
    public function lessonsAction(Request $request)
    {
        $lessonRequest = $request->request->get('lesson');
        
        $em = $this->getDoctrine()->getManager();
        
        $lesson = $em->getRepository('ReservationBundle:Lessons')->find($lessonRequest);

        if (!$lesson) {
            throw $this->createNotFoundException(
                'No product found for id '.$lesson["id"]
            );
        }
        
        $em->remove($lesson);
        $em->flush();
        
        return new Response();
    }
    
    /**
     * @Route("/classrooms/delete")
     * @Method({"POST"})
     */
    public function classroomsAction(Request $request)
    {
        $classroomRequest = $request->request->get('classroom');
        
        $em = $this->getDoctrine()->getManager();
        
        $classroom = $em->getRepository('ReservationBundle:Classrooms')->findBy($classroomRequest);

        if (!$classroom) {
            throw $this->createNotFoundException(
                'No product found for id '.$classroom["id"]
            );
        }
        
        $em->remove($classroom);
        $em->flush();
        
        return new Response();
    }
}
