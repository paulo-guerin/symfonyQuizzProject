<?php
namespace App\Controller;

use App\Entity\Player;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\AnswerQuizzQuestion;
use App\Entity\Quizz;
use App\Entity\QuizzQuestion;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz", name="quizz", methods={"GET", "POST", "HEAD"})
     */
    public function quizz(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $questionRepository = $entityManager->getRepository(Question::class);

        if($request->isMethod('post')){
            $quizz = new Quizz;

            $player = new Player;
            $player->setEmail('test@gmail.com');
            $entityManager->persist($player);
            $entityManager->flush();

            $quizz->setPlayer($player);

            $questionsIds = explode("|", $request->request->get('questionsIds'));
            $answersIds = [];
            foreach($request->request as $answerId => $checked){
                if($answerId != "questionsIds"){
                    $answersIds[] = $answerId;
                }
            }
            $questions = [];
            foreach($questionsIds as $questionId){
                $quizzQuestion = new QuizzQuestion;
                $questions[] = $question = $questionRepository->find($questionId);
                $quizzQuestion->setQuestion($question);
                $quizzQuestion->setQuizz($quizz);
                $entityManager->persist($quizzQuestion);
                $quizz->addQuizzQuestion($quizzQuestion);
            }

            $entityManager->persist($quizz);
            $entityManager->flush();

            $correction = $this->checkAnswers($questions, $answersIds, $quizzQuestion, $entityManager);
            
            

            return $this->render('quizz/correction.html.twig', [
                'questions' => $questions,
                'correction' => $correction
            ]);
        }
        
        else{
            $questions = $questionRepository->getRandomQuestions();
            $questionsIds = '';
            $count = count($questions);
            foreach($questions as $question){
                if (--$count <= 0) {
                    $questionsIds .= $question->getId();
                } else {
                    $questionsIds .= $question->getId().'|';
                }
            }
            return $this->render('quizz/quizz.html.twig', [
                'questions' => $questions,
                'questionsIds' => $questionsIds
            ]);
        }
        
    }

    private function checkAnswers($questions, $answersIds, $quizzQuestion, $entityManager)
    {
        $results = [];
        $idsAnswersTrue = [];
        $idsAnswersFalse = [];
        foreach($questions as $question){
            $questionSuccess = 1;
            foreach($question->getAnswers() as $answer){
                $answerQuizzQuestion = new AnswerQuizzQuestion;
                $answerQuizzQuestion->setQuizzQuestion($quizzQuestion);
                $answerQuizzQuestion->setAnswer($answer);
                if($answer->getCorrect() === true && in_array($answer->getId(), $answersIds)){
                    $idsAnswersTrue[] = $answer->getId();
                    $answerQuizzQuestion->setPlayerAnswer(true);
                } else if ($answer->getCorrect() === false && in_array($answer->getId(), $answersIds)){
                    $idsAnswersFalse[] = $answer->getId();
                    $questionSuccess = 0;
                    $answerQuizzQuestion->setPlayerAnswer(true);
                } else if ($answer->getCorrect() === true && !in_array($answer->getId(), $answersIds)){
                    $questionSuccess = 0;
                    $answerQuizzQuestion->setPlayerAnswer(false);
                } else if ($answer->getCorrect() === false && !in_array($answer->getId(), $answersIds)){
                    $answerQuizzQuestion->setPlayerAnswer(false);
                }
                $entityManager->persist($answerQuizzQuestion);
                $entityManager->flush();
            }
            $results[] = $questionSuccess;
        }
        $score = array_sum($results) . '/' . count($results);
        return ['score' => $score, 'idsAnswersTrue' => $idsAnswersTrue, 'idsAnswersFalse' => $idsAnswersFalse];
    }
}