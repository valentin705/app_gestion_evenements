<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EventFilterType;
use App\Repository\EventRepository;
use App\Service\EventFilterService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\EventService;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]

    public function showListEvents(Request $request, EventFilterService $eventFilterService, 
    EventRepository $eventRepository): Response
{
    $user = $this->getUser();

    $form = $this->createForm(EventFilterType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        $events = $eventFilterService->filterByDateRange($data['startDate'], $data['endDate']);
    } else {
        $events = $eventRepository->findAll();
    }

    return $this->render('home/index.html.twig', [
        'events' => $events,
        'user' => $user,
        'form' => $form->createView(),
    ]);
}

#[Route('/event/{id}/register', name: 'event_register')]
public function register(Event $event, EventService $eventService): Response {
    $user = $this->getUser();
    $eventService->registerUserToEvent($user, $event);
    return $this->redirectToRoute('app_home');
}

#[Route('/event/{id}/unregister', name: 'event_unregister')]
public function unregister(Event $event, EventService $eventService): Response {
    $user = $this->getUser();
    $eventService->unregisterUserFromEvent($user, $event);
    return $this->redirectToRoute('app_home');
}

}
