<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Event;

class UserProfilController extends AbstractController
{
    #[Route('/user/profil', name: 'app_user_profil')]
    public function index(EventRepository $eventRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            // Redirigez vers la page de connexion ou une autre page si l'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_login');
        }

        $events = $eventRepository->findBy(['user' => $user]);
        $participatingEvents = $eventRepository->findEventsByParticipant($user);


        return $this->render('user_profil/index.html.twig', [
            'user' => $user,
            'events' => $events,
            'participatingEvents' => $participatingEvents,
        ]);
    }

    #[Route('/user/profil/{id}/unregister_event', name: 'event_user_unregister')]
    public function unregister(Event $event, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();
    $user->removeRegisteredEvent($event);
    $entityManager->persist($user);
    $entityManager->flush();

    return $this->redirectToRoute('app_user_profil');

}



}
