<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{
    /**
     * @Route("/questions", name="questions", methods={"GET","HEAD"})
     */
    public function list(): Response
    {
        return $this->render('question/list.html.twig', [
        ]);
    }

    // /**
    //  * @Route("/question/{id}", name="question", methods={"GET","HEAD"})
    //  */
    // public function show(int $id): Response
    // {
    //     // ... return a JSON response with the post
    // }

    // /**
    //  * @Route("/question/{id}", name="question_edit", methods={"PUT"})
    //  */
    // public function edit(int $id): Response
    // {
    //     // ... edit a post
    // }

    // /**
    //  * @Route("/question/{id}", name="question_delete", methods={"DELETE"})
    //  */
    // public function delete(int $id): Response
    // {
    //     // ... delete a post
    // }
}