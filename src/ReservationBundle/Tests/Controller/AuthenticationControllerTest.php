<?php

namespace ReservationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationControllerTest extends WebTestCase
{
    public function testAuthentication()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
