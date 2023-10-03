<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EventService;

class EditEventController extends AbstractController
{
    #[Route('/event/edit/{id}', name: 'app_update_event')]
    public function updateEvent(Request $request, EventService $eventService, Event $event): Response
    {

        $user = $this->getUser();
        if ($user != $event->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventService->updateEvent($event);
            $this->addFlash('success', 'Événement mis à jour avec succès!');
            return $this->redirectToRoute('app_user_profil');
        }

        return $this->render('event/edit.html.twig', [
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
