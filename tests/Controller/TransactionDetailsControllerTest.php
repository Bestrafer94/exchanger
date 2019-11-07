<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransactionDetailsControllerTest extends WebTestCase
{
    public function testDetails()
    {
        $client = $this->createClient();
        $client->request('GET', '/transaction/5');

        $this->assertResponseIsSuccessful();
    }
}
