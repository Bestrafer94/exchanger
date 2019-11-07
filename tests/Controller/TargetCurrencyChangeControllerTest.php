<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TargetCurrencyChangeControllerTest extends WebTestCase
{
    public function testChangeCurrency()
    {
        $client = $this->createClient();
        $client->request('PATCH', '/transaction/2');

        $this->assertResponseIsSuccessful();
    }
}
