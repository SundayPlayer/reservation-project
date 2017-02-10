<?php

namespace ReservationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationController extends Controller
{
    /**
     * @Route("/authentication")
     * @Method({"POST"})
     */
    public function authenticationAction(Request $request)
    {
        $data = $request->request->get('authentication');
        
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('ReservationBundle:Users')->findOneBy(array("email" => $data["email"]));
        
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for email '.$data["email"]
            );
        }
        
        $response = checkPassword($data, $user);
                
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }
    
    private function checkPassword($data, $user)
    {
        $response = new JsonResponse();
        
        if (password_hash($data["password"], PASSWORD_DEFAULT) == $user->getPassword()) {
            switch ($user->getAccessType()) {
                case 0:
                    $token = array("token" => "8F1B169977DB5C7E53977985BFDC3");
                    break;
                case 1:
                    $token = array("token" => "9896388713E169FB61F95C2D26DF4");
                    break;
                case 2:
                    $token = array("token" => "55C284435352611D85B285DCA54A6");
                    break;
            }
            $response->setData($token);
        }
        else {
            $response->setData(array("token" => NULL));
        }
        
        return $response;
    }

}
