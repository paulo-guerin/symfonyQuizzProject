<?php
namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class QuestionAnswerFixtures extends Fixture
{   
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $question = new Question();
            $question->setContent($this->faker->text . '?');
            $manager->persist($question);
            for ($n = 0; $n <= 4; $n++) {
                $answer = new Answer();
                $answer->setContent($this->faker->sentence(10) . '?');
                $answer->setQuestion($question);
                $answer->setCorrect(rand(0,1));
                $manager->persist($answer);
            }
        }
        $manager->flush();
    }
}