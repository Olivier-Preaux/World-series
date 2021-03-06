<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('program_index');
    }

    public function navbarTop(CategoryRepository $categoryRepository): Response
{
   return $this->render('layout/navbartop.html.twig', [
      'categories' => $categoryRepository->findBy([], ['id' => 'DESC'])
   ]);
}
}
