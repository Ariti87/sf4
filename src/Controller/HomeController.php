<?php


namespace App\Controller;

use App\Repository\RecordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecordRepository $recordRepository)
    {
        $top = $recordRepository->getBestRatedOfYear();
        return $this->render('index.html.twig',[
            'top' => $top
        ]);
    }
}