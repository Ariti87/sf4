<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/label",name="label_")
 */
class LabelController extends AbstractController
{
    /**
     * @Route("/{id}",name="page")
     */
    public function index($id)
    {
        return $this->json([
            'id' => $id,
        ]);
    }
}