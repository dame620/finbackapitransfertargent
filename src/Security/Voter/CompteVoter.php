<?php

namespace App\Security\Voter;

use Exception;
use App\Entity\Compte;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CompteVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST', 'EDIT'])
            && $subject instanceof \App\Entity\Compte;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
       //dd($user);
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $role=$user->getRole()->getLibelle();
        //dd($role);
        if($role=="SUPADMIN" || $role=="ADMIN"){

            return true;
        }
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'POST':
                // logic to determine if the user can EDIT
                // return true or false
                break;
            case 'EDIT':
                // logic to determine if the user can VIEW
                // return true or false
                break;
        }

     
        throw new Exception("attention vous n etes pas autoriser à effectuer cette action");
    }
}
