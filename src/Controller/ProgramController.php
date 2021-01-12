<?php

namespace App\Controller;


use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/program")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="program_index", methods={"GET"})
     */
    public function index(ProgramRepository $programRepository): Response
    {   
        return $this->render('program/index.html.twig', [
            'programs' => $programRepository->findAll(),
           
        ]);
    }

    /**
     * @Route("/new", name="program_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"} ,name="program_show", methods={"GET"})
     */
    public function show(Program $program): Response
    {   
        $season = $program->getSeasons();
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $season
        ]);
    }

    /**
     * @Route("/{id}/edit", name="program_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Program $program): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Program $program): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($program);
            $entityManager->flush();
        }

        return $this->redirectToRoute('program_index');
    }

    /**
     * Show season by program id and season id
     * @Route("/{program_id}/season/{season_id} ", name="program_show_season", requirements={"program"="\d+", "season"="\d+"})
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     */
    public function showSeason(program $program, season $season)
    {
       $episodes = $season->getEpisodes() ;
       
       
        return $this->render('program/show_season.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

        /**
     * Show episode by program id , season id and episode id
     * @Route("/{program_id}/season/{season_id}/episode/{episode_id} ", name="program_show_episode", requirements={"program"="\d+", "season"="\d+" ,  "episode"="\d+"})
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episode_id": "id"}})
     */
    public function showEpisode(program $program, season $season , episode $episode )
    {           
        return $this->render('program/show_episode.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }
}
