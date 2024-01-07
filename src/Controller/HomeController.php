<?php

namespace App\Controller;

use App\Service\StarsWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly StarsWarsApiService $starsWarsApiService)
    {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $personnages = $this->starsWarsApiService->getPersonnages();

        return $this->render('home/index.html.twig', [
            'personnages' => $personnages,
        ]);
    }

    #[Route('/personnage/{id}', name: 'app_personnage', requirements: ['id' => '\d+'])]
    public function personnage(int $id): Response
    {
        $personnage = $this->starsWarsApiService->getPersonnage($id);

        return $this->render('home/personnage.html.twig', [
            'personnage' => $personnage,
        ]);
    }
}
