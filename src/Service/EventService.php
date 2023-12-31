<?php

namespace App\Service;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class EventService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function registerUserToEvent($user, Event $event): void
    {
        $user->addRegisteredEvent($event);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function unregisterUserFromEvent($user, Event $event): void
    {
        $user->removeRegisteredEvent($event);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function createEvent(Event $event, User $user): void
    {
        $event->setUser($user);
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    public function updateEvent(Event $event): void
    {
        $this->entityManager->flush();
    }

    public function deleteEvent(Event $event): void
    {
        $this->entityManager->remove($event);
        $this->entityManager->flush();
    }
}
