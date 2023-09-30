<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Event;
use App\Form\EventType;

class AddEventController extends AbstractController
{
    #[Route('/add/event', name: 'app_add_event')]
    public function addEvent(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        Event $event = null
    ) {
        if (!$event) {
            $event = new Event();
        }
        $user = $this->getUser();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event->setUser($user);
            $entityManagerInterface->persist($event);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('add_event/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
