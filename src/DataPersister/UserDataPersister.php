<?php
namespace App\DataPersister;
use App\Entity\Compte;
use App\Repository\RoleRepository;
use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserDataPersister implements DataPersisterInterface
{

    private $entityManager;
    private $repocont;
    private $rolrepo;
    public function __construct(EntityManagerInterface $entityManager,ContratRepository $repocont, UserPasswordEncoderInterface $userPasswordEncoder, RoleRepository $rolrepo )
    {
        
        $this->entityManager = $entityManager;
        $this->repocont =  $repocont;
        $this->rolrepo =  $rolrepo;
    }

    



    public function supports($data): bool
    {
        
        return $data instanceof Compte;
       
    }
    
    /**
     * @param Compte $data
     */
    public function persist($data)

      {

        //recuperation de l id du user partenaire avant flush dans la base de donné 

        $idpartenaire = $data->getPartenaire()->getusers()[0]->getId();
       // dd($idpartenaire);
     
       //$term = $this->repocont->findBy(['id'=>1]);
    
       $term=$this->repocont->findAll();
    
        $texterme=$term[0]->getTerme();
       // dd($texterme);

        $nompersonne = $data->getPartenaire()->getusers()[0]->getNomcomplet();
        $nineaperson = $data->getPartenaire()->getNinea();
        $search=["#nomcomplet","#ninea"];
        $replace=[$nompersonne,$nineaperson];

        $newtexterme=str_replace ($search ,$replace , $texterme );

        //recuperation des roles partenaire
        $allrol=$this->rolrepo->findAll();
        //recuperation du role partenaire 
        $rolpart=$allrol[3];
       // dd($rolpart);
        //recuperation du user a qui appartient le compte
        $usercom = $data->getPartenaire()->getusers()[0];
     
        
       // dd($idpartenaire);
//s'il s'agit d'un compte pour un nouveau partenaire
       if($idpartenaire == null){
   //donner au user le role partenaire

        $usercom->setRole($rolpart);

       }

        

        $this->entityManager->persist($data);
        $this->entityManager->flush();

       if($idpartenaire == null){

        return new JsonResponse($newtexterme);

       }
        
       }

    public function remove($data)
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }



}



