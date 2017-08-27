<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppAvailabilityTest extends WebTestCase
{

    /**
     * @dataProvider urlProvider
     */
    public function testPageLoadIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return [
            ['/'],
            ['news'],
            ['contact'],
        ];
    }
}
