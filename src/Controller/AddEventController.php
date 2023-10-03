<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Event;
use App\Form\EventType;
use App\Service\EventService;

class AddEventController extends AbstractController
{
    #[Route('/event/add', name: 'app_add_event')]
    public function addEvent(Request $request, EventService $eventService, Event $event = null): Response {
        if (!$event) {
            $event = new Event();
        }
        
        $user = $this->getUser();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $eventService->createEvent($event, $user);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('event/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
