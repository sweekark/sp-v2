<?php

namespace App\Controller;

use App\Entity\Exceptions;
use App\Entity\Persons;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ExceptionsController extends AbstractController
{
    /**
     * @Route("/exceptions", name="exceptions")
     */
    public function index()
    {
        return $this->render('exceptions/index.html.twig', [
            'controller_name' => 'ExceptionsController',
        ]);
    }

    /**
     * @Route("/exceptions/add", name="exceptions_add")
     */
    public function exceptions_add(Request $request)
    {   
        $exception =new Exceptions();
        $exception->setStatus('Pending');

        $form = $this->createFormBuilder($exception)
        ->add('PersonID', EntityType::class, [
            'class' => Persons::class,
            'choice_label' => 'PersonID',
        ])
        ->add('Date', TextType::class)
        ->add('Reason', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Add Exception'])
        ->getForm();
        
        $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $task = $form->getData();

        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($exception);
        $entityManager->flush();

        return new Response('<html><body>Exception Successfully Added</body></html>');
        }

        return $this->render('exceptions/exceptions_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/exceptions/{id}", name="exceptions_show")
     */
    public function exceptions_show($id)
    {   
        $person = $this->getDoctrine()
            ->getRepository(Persons::class)
            ->find($id);
        
        $exceptions = $person->getExceptions();

        return $this->render('exceptions/exceptions_profile.html.twig', ['exceptions' => $exceptions]);

    }
}