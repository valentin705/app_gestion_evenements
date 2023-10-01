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

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]

    // public function showListEvents(
    //     EventRepository $eventRepository
    // ): Response {

    //     $user = $this->getUser();
    //     $events = $eventRepository->findAll();
    //     return $this->render('home/index.html.twig', [
    //         'events' => $events,
    //         'user' => $user,
    //     ]);

    // }

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

}
