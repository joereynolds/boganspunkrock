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

    /**
     * @dataProvider restrictedUrlProvider
     */
    public function testRestrictedPagesRedirect($url)
    {
        $this->client->request('GET', $url);
        $this->assertTrue($this->client->getResponse()->isRedirect());
    }

    public function restrictedUrlProvider()
    {
        return [
            ['/admin'],
            ['/admin/gigs/1000']
        ];
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
