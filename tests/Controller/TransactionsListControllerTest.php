<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransactionsListControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = $this->createClient();
        $client->request('GET', '/transactions');

        $this->assertResponseIsSuccessful();
    }
}
