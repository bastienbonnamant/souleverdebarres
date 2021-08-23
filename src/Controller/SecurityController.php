<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, MailerInterface $mailer): Response{

        $user = new User(); 
        // J'instencie un nouvel objet de la class(ou entité)  USER

        $form = $this->createForm(RegistrationType::class, $user); 
        //J'utilise la fonction createForm pour instancier le formulaire en lui passant en parametre le nom de la classe du formulaire ainsi que la variable
        // dans laquelle est mon objet, afin d'avoir acces à ses fonctions.

        $form->handleRequest($request);
        // handleRequest permet de gérer le traitement de la saisie du formulaire par l'utilisateur.  On lui passe en parametre l'injection de dépendance $request.

        if($form->isSubmitted() && $form->isValid()){
        //C’est l’instruction $form->isSubmitted() qui permet de savoir si le formulaire a été saisi et si de plus les règles de validations sont vérifiées
        // ($form->isValid()) alors l’enregistrement sera ajouté à la base de données avant de rediriger la requête vers un affichage de la liste des locations.
            
            $hash = $encoder->encodePassword($user, $user->getPassword());
            //Avant de sauvegarder l'utilisateur, on veut un hash qui est égale à notre fonction encodePassword qui prend en parametre $user car c'est l'entité User
            // dans security.yaml on a defini que l'entité user avait un encodage bcrypt.
            // Enfin on lui dit ou est le mot de passe qu'on souhaite encoder, et ce mdp est dans $user->getPassword

            $user->setPassword($hash);
            //On modifie donc le password avec set et on lui passe en parametre la hashage avec $hash

            $em->persist($user);
            // Le persist va dire que l'entité qu'on lui passe en parametre, dans ce cas $user est lié à la bdd

            $em->flush();
            //Envoi les infos saisies dans la base de donnée. A partir de la, l'objet est converti en requete SQL

            $email = (new Email())
                ->from('your_email@example.com')
                ->to('bastien.bonnamant@gmail.com')
                ->subject('Inscription à Souleverdesbarres.com')
                ->html('<p>Tu es bien inscrit au site souleverdesbarres.com !</p>');

            $mailer->send($email);

            $this->getParameter('mailer_from');

                return $this->redirectToRoute('security_login');
                //le redirecttoroute fait une redirection web vers une route ici 'security_login'
                
            }

        return $this->render('security/registration.html.twig', [
            //render fait une redirection vers un moteur de template twig
            'form' => $form->createView()
            //'form est le nom qu'on donne au formulaire afin de pouvoir l'appeler dans twig
            //'form' est donc stocké dans une variable $form à qui je dis de créer la vue. Ensuite il faudra aller dans twig créer le formulaire
            //en faisant {{form(form)}}, on met form entre parentheses car il est égal à 'form'
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
       
        return $this->render('security/login.html.twig');
    }

     /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){
        
    }

    /**
     * @Route("/user", name="user_page")
     */
    public function userpage(){
       
        return $this->render('security/user.html.twig');
    }


}
