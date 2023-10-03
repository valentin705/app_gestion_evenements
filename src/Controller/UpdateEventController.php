<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EventService;

class UpdateEventController extends AbstractController
{
    #[Route('/update/event/{id}', name: 'app_update_event')]
    public function updateEvent(Request $request, EventService $eventService, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventService->updateEvent($event);
            $this->addFlash('success', 'Événement mis à jour avec succès!');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('update_event/index.html.twig', [
            'eventForm' => $form->createView(),
            'event' => $event,
        ]);
    }

    #[Route('/update/event/{id}/delete_event', name: 'app_delete_event')]
    public function deleteEvent(EventService $eventService, Event $event): Response
    {
        $eventService->deleteEvent($event);
        $this->addFlash('success', 'Événement supprimé avec succès!');
        return $this->redirectToRoute('app_user_profil');
    }

}
