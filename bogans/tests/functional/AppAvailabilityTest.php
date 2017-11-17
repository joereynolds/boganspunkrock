<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppAvailabilityTest extends WebTestCase
{

    public function setUp()
    {
        $this->client = self::createClient();
    }


    /**
     * @dataProvider urlProvider
     */
    public function testPageLoadIsSuccessful($url)
    {
        $this->client->request('GET', $url);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testAdminPageRedirects()
    {
        $this->client->request('GET', '/admin');
        $this->assertTrue($this->client->getResponse()->isRedirect());
    }

    public function urlProvider()
    {
        return [
            ['/'],
            ['news'],
            ['contact'],
            ['reviews'],
            ['login'],
            ['gigs'],
        ];
    }
}
