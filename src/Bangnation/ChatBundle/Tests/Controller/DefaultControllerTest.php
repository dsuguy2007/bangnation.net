<?php

namespace Bangnation\ChatBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    protected $client;
    
    protected function setUp()
    {
        $this->client = static::createClient();

        $this->client->followRedirects();

        $crawler = $this->client->request('GET', '/login');
        
        $extract = $crawler->filter('input[name="_csrf_token"]')
          ->extract(array('value'));
        
        $csrf_token = $extract[0];
        
        $form =$crawler->selectButton('_submit')->form();
        $form['_username'] = 'super_admin';
        $form['_password'] ='123';
        $form['_csrf_token'] = $csrf_token;
        
        $this->client->submit($form);
    }
    
    protected function tearDown()
    {
        $this->client->request('GET', '/logout');
    }
    
    public function testHeartbeat()
    {
        $crawler = $this->client->request(
            'GET', 
            '/chat/heartbeat',
            array(),
            array(),
            array(
                'CONTENT_TYPE' => 'application/json',
                'HTTP_REFERER' => '/',
            )
        );
        
        $response = json_decode($crawler->text(), true);

        $this->assertArrayHasKey('items', $response);
    }

}
