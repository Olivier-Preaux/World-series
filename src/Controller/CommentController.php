<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Slugify;
use Doctrine\ORM\Mapping as ORM ;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    #[Route('/', name: 'comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepository ): Response   {   
        

        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
          
        ]);
    }

    
   /**
     * @Route("/new/{slug}",name="comment_new", methods={"GET","POST"})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"slug": "slug"}})
     */
    public function new(Request $request , episode $episode): Response
    {   
       
        $comment = new Comment();
       
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setEpisode($episode);
            $comment->setAuthor($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('program_index');
        }

        return $this->render('comment/new.html.twig', [            
            'episode' => $episode ,
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{id}/edit', name: 'comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comment $comment): Response
    {

        // Check wether the logged in user is the owner of the program / or admin
        if (!(($this->getUser() == $comment->getAuthor()) OR ($this->isGranted('ROLE_ADMIN')) )) {
            // If not the owner, throws a 403 Access Denied exception
            throw new AccessDeniedException('Only the author can edit the comment!');
        }
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_index');
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'comment_delete', methods: ['DELETE'])]
    public function delete(Request $request, Comment $comment): Response
    {   
        // Check wether the logged in user is the owner of the program / or admin
        if (!(($this->getUser() == $comment->getAuthor()) OR ($this->isGranted('ROLE_ADMIN')) )) {
            // If not the owner, throws a 403 Access Denied exception
            throw new AccessDeniedException('Only the author can edit the comment!');
        }
        
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index');
    }
}
