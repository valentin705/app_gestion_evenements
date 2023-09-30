<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class UpdateEventController extends AbstractController
{
    #[Route('/update/event/{id}', name: 'app_update_event')]
    public function updateEvent(Request $request, EntityManagerInterface $entityManager, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Événement mis à jour avec succès!');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('update_event/index.html.twig', [
            'eventForm' => $form->createView(),
            'event' => $event,
        ]);
    }

    // #[Route('/update/event/{id}/delete_event/{event}', name: 'app_delete_event')]
    #[Route('/update/event/{id}/delete_event', name: 'app_delete_event')]
    public function deleteEvent(Event $event, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($event);
        $entityManager->flush();
        $this->addFlash('success', 'Événement supprimé avec succès!');
        return $this->redirectToRoute('app_home');

    }

}
