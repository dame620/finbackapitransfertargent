<?php

namespace App\Security\Voter;

use Exception;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserVoter extends Voter
{
    /*
    const ROLE_SUPADMIN = 'ROLE_SUPADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_CAISSIER = 'ROLE_CAISSIER';
    */
    private $security;
    private $tokenStorage;
    private $decisionManager;
    

    public function __construct(Security $security, TokenStorageInterface $tokenStorage, AccessDecisionManagerInterface $decisionManager )
    {
        $this->security = $security;
        $this->tokenStorage = $tokenStorage;
        $this->decisionManager = $decisionManager;
    }

    
    protected function supports($attribute, $subject)
    {
   

return in_array($attribute, ['EDIT', 'VIEW', 'POST'])
         && $subject instanceof \App\Entity\User;

   
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {

        
     //dd($subject);
     //user connecté
         $user = $token->getUser();
        
        // if the user is anonymous, do not grant access
        
        if (!$user instanceof UserInterface) {
            return false;
        }
        
       // $rol = $subject->getRole()->getLibelle();
      //  $subject->setRoles(array("ROLE_".$rol));

        //dd($user->getRole()->getLibelle());
       if($user->getRole()->getLibelle() == "SUPADMIN"){
        return true;
       }
      
       if($user->getRole()->getLibelle() == "CAISSIER" || $user->getRole()->getLibelle() == "USERPARTENAIRE"){
        throw new Exception("attention vous ne pouvez pas effectuer cette action en tant que caissier");
    }
   // dd($user->getRole()->getLibelle());
    //dd($user->getRole()->getLibelle());
   // $makhou = ($user->getRoles()[0]);
  // dd($user->getRoles()[0]);
  if(($user->getRole()->getLibelle()=== "ADMIN") &&(
    $subject->getRole()->getLibelle() == "SUPADMIN" || $subject->getRole()->getLibelle() == "ADMIN" 
 )){
    throw new Exception("attention vous ne pouvez pas effectuer cette action en tant que admin");
 }

 if(($user->getRole()->getLibelle()=== "PARTENAIRE") &&(
    $subject->getRole()->getLibelle() == "SUPADMIN" || $subject->getRole()->getLibelle() == "ADMIN" 
    || $subject->getRole()->getLibelle() == "CAISSIER" 
 )){
    throw new Exception("attention vous ne pouvez pas effectuer cette action en tant que partenaire");
 }


 if(($user->getRole()->getLibelle()=== "ADMINPARTENAIRE") &&(
    $subject->getRole()->getLibelle() == "SUPADMIN" || $subject->getRole()->getLibelle() == "ADMIN" 
    || $subject->getRole()->getLibelle() == "CAISSIER" || $subject->getRole()->getLibelle()=== "PARTENAIRE"
    || $subject->getRole()->getLibelle()=== "ADMINPARTENAIRE"
 )){
    throw new Exception("attention vous ne pouvez pas effectuer cette action en tant que partenaire");
 }

       switch ($attribute) {
        case 'POST':
            
        break;

            case 'VIEW':
          
            break;
                
            case 'EDIT':

             
            break;
                 }
 
               return true;
  }
}
