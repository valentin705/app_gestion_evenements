<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]

    public function showListEvents(
        EventRepository $eventRepository
    ): Response {

        $user = $this->getUser();
        $events = $eventRepository->findAll();
        return $this->render('home/index.html.twig', [
            'events' => $events,
            'user' => $user,
        ]);

    }

}
