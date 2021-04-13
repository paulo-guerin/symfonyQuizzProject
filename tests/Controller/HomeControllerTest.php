<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebtestCase;

class HomeControllerTest extends WebtestCase{

    /*
    * Scénario :
    * Un utlilisateur va sur la page homepage en get
    */
    public function testHomepageGet(){
        $client = static::createClient();
        //Le crawler est une variable qui permet d'analyser le contenu que renvoie le client (stocke le DOM)
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // $this->assertSelectorTextContains('html h1', 'Liste des questions');
        $this->assertCount(1, $crawler->filter('h1'));
    }

    /*
    * Scénario :
    * Un utilisateur soumet un formulaire
    */
    public function testHomepagePost(){
        $client = static::createClient();
        $email = 'test@gmail.com';
        //Le crawler est une variable qui permet d'analyser le contenu que renvoie le client (stocke le DOM)
        $client->request('POST', '/', [
            'form' => [
                'email' => $email
            ]
        ]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}