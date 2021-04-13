<?php
namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET", "POST", "HEAD"})
     */
    public function homepage(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $player = new Player();

        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $player = $form->getData();

            $entityManager->persist($player);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                $request->request->get('email') . ' vous serez notifiés de l\'arrivée du quizz!'
            );
        }

        $players = $entityManager->getRepository(Player::class);
        $players = count($players->findAll());
        return $this->render('home/homepage.html.twig', [
            'form' => $form->createView(),
            'players' => $players
        ]);
    }
}