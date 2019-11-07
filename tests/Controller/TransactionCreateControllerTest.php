<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransactionCreateControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = $this->createClient();
        $client->request('POST', '/transaction');

        $this->assertResponseIsSuccessful();
    }
}
