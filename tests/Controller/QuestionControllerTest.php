<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebtestCase;

class QuestionControllerTest extends WebtestCase{

    /*
    * Scénario :
    * Un utlilisateur va sur la page list
    */
    public function testHomepage(){
        $client = static::createClient();
        //Le crawler est une variable qui permet d'analyser le contenu que renvoie le client (stocke le DOM)
        $crawler = $client->request('GET', '/questions');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // $this->assertSelectorTextContains('html h1', 'Liste des questions');
        $this->assertCount(1, $crawler->filter('h1'));
    }
}