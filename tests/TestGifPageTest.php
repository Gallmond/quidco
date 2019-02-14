<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestGifPageTest extends WebTestCase
{

	/**
	 * Just shows page loading.
	 */
    public function testBasePageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/showgif');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }

	/**
	 * Basic check tag exists
	 */
    public function testImageReturned(){

		$client = static::createClient();
		$client->request('GET', '/showgif?search_term=dog');

		$this->assertSame(200, $client->getResponse()->getStatusCode());
    	$this->assertContains("<img src=", $client->getResponse()->getContent());

	}

}
