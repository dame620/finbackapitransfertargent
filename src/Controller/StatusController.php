<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatusController extends AbstractController
{
    /**
     * @Route("/api/users/status/{id}", name="status_desable", methods="GET")
     */
    public function status($id,UserRepository $repo)
    {
        $user = $repo->find($id);
        $status = '';
        if($user->getIsActive() == true){
            $user->setIsActive(false); 
            $status = 'Desactivé';
        }

        else{

            $user->setIsActive(true); 
            $status = 'Activé';
        }
       
        $manager =  $this->getDoctrine()->getManager(); 
        $manager->persist($user);
        $manager->flush();
        $data=[
            'status'=>200,
            'message'=>$user->getUsername().' est '.$status
        ];
        return $this->json($data, 200);
    }

}
