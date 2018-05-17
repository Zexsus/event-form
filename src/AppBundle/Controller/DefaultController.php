<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="event-form")
     */
    public function indexAction(Request $request)
    {   
        $entityManager = $this->getDoctrine()->getManager();
        $event = new Event();
        $form = $this->createFormBuilder($event)
            ->add('name', TextType::class)
            ->add('startDate', DateTimeType::class)
            ->add('endDate', DateTimeType::class)
            ->add('timeZone', TimezoneType::class)
            ->add('save', SubmitType::class, array('label' => 'Add Event'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
        }

        $events = $entityManager->getRepository('AppBundle:Event')->findAll();

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'events' => $events
        ]);
    }

}
