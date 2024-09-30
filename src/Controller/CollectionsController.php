<?php

namespace App\Controller;

use App\Repository\CollectionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Collections;
use Doctrine\Persistence\ManagerRegistry;

class CollectionsController extends AbstractController
{
    #[Route('/collections', name: 'app_collections')]
    public function index(): Response
    {
        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
        ]);
    }
    /**
     * Lists all tags entities.
     */
    #[Route('/collections/list', name: 'collections_list', methods: ['GET'])]
    public function listAction(CollectionsRepository $collectionsRepository)
    {
        $htmlpage = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Collections list!</title>
    </head>
    <body>
        <h1>collections list</h1>
        <p>Here are all your collections:</p>
        <ul>';
        
        $collections = $collectionsRepository->findAll();
        foreach($collections as $collection) {
            $url = $this->generateUrl(
                'collections_show',
                ['id' => $collection->getId()]);
            $htmlpage .= '<li>
            <a href="'. $url .'">'. $collection->getTitle()  .'</a></li>';
        }
        $htmlpage .= '</ul>';
        
        $htmlpage .= '</body></html>';
        
        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
            );
    }
    /**
     * Show a [inventaire]
     *
     * @param Integer $id (note that the id must be an integer)
     */
    #[Route('/collections/{id}', name: 'collections_show', requirements: ['id' => '\d+'])]
    public function show(Collections $collections) : Response
    {
       
        $htmlpage = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>collection n° '.$collections->getId().' details</title>
    </head>
    <body>
        <h2>Collection Details :</h2>
        <ul>
        <dl>';
        
        $htmlpage .= '<dt>Description</dt><dd>' . $collections->getDescription() . '</dd>';
        $htmlpage .= '</dl>';
        $htmlpage .= '</ul></body></html>';
        
        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
            );
    
    }
    
}
