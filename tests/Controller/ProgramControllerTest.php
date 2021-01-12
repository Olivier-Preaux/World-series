<?php

namespace App\Tests\Controller ;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProgramControllerTest extends WebTestCase
{   
    /**
    * @dataProvider urlProvider
    */
    public function testProgram($url)
    {
        $client = static::createClient(); 
        $client->request('GET',$url);

        $this->assertResponseIsSuccessful($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
   {
       return [
          ['/'],
          ['/program'],
          ['/program/1'],
          ['/program/2'],
        ];
   }




}

