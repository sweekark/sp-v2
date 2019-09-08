<?php

namespace App\Controller;

use App\Entity\Persons;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonsController extends AbstractController
{
    /**
     * @Route("/persons", name="persons")
     */
    public function index()
    {
        return $this->render('persons/index.html.twig', [
            'controller_name' => 'PersonsController',
        ]);
    }


    /**
     * @Route("/persons/add", name="persons_add")
     */
    public function persons_add(Request $request)
    {   
        $person =new Persons();
        $person->setGroupName('Random');
        $person->setBayName('Random');
        $person->setPersonID(strval(random_int(1,10000000000)));

        $form = $this->createFormBuilder($person)
        ->add('Name', TextType::class)
        ->add('DOB', DateType::class)
        ->add('Gender', TextType::class)
        ->add('Phone', TextType::class)
        ->add('EmailID', TextType::class)
        ->add('Marital_Status', TextType::class)
        ->add('Country', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Add Me!'])
        ->getForm();
        
        $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $task = $form->getData();

        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($person);
        $entityManager->flush();

        return new Response('<html><body>successfully added</body></html>');
    }

        return $this->render('persons/persons_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/persons/{id}", name="persons_profile")
     */
    public function persons_profile($id)
    {   
        $profile = $this->getDoctrine()
            ->getRepository(Persons::class)
            ->find($id);
        
            return $this->render('persons/persons_profile.html.twig', ['profile' => $profile]);




    }
}
