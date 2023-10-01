<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    public function testCreateUser(): void
    {
        // Create an instance of the User entity
        $user = new User();
        $user->setUsername('john_doe');
        $user->setEmail('john@example.com');
        $user->setPassword('password123');

        // Check that the user was successfully created
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('john_doe', $user->getUsername());

        // You can add additional assertions here to check other properties of the user if needed.
    }
}
