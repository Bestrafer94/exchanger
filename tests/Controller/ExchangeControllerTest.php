<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExchangeControllerTest extends WebTestCase
{
    public function testExchange()
    {
        $client = $this->createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
