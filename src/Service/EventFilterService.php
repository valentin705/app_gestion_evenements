<?php

namespace App\Service;

use App\Repository\EventRepository;

class EventFilterService
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function filterByDateRange(\DateTime $startDate, \DateTime $endDate)
    {
        return $this->eventRepository->findByDateRange($startDate, $endDate);
    }
}