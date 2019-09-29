<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Avis;
use App\Entity\Etapes;
use App\Entity\Unites;
use App\Entity\Recettes;
use App\Entity\Ustensiles;
use App\Entity\Ingredients;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function index()
    {
        $rec = $this->getDoctrine()->getRepository(Recettes::class);
        
        $recettes = $rec->findAll();

        return $this->render('recipe/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }
    
    /**
     * @Route("recipe/{id}", name="tarte-au-chocolat")
     */
    public function show($id)
    {
        $rec = $this->getDoctrine()->getRepository(Recettes::class);
        $tag = $this->getDoctrine()->getRepository(Tag::class);
        $avi = $this->getDoctrine()->getRepository(Avis::class);
        $eta = $this->getDoctrine()->getRepository(Etapes::class);
        $ing = $this->getDoctrine()->getRepository(Ingredients::class);
        $uni = $this->getDoctrine()->getRepository(Unites::class);
        $use = $this->getDoctrine()->getRepository(Ustensiles::class);

        $recettes = $rec->find($id);
        $tags  = $tag->findAll();
        $avis = $avi->findAll();
        $etapes = $eta->findAll();
        $ingredients = $ing->findAll();
        $unites = $uni->findAll();
        $ustensiles = $use->findAll();

        return $this->render('recipe/tarteAuChocolat.html.twig', [
            'recettes' => $recettes,
            'tags' => $tags,
            'avis' => $avis,
            'etapes' => $etapes,
            'ingredients' => $ingredients,
            'unites' => $unites,
            'ustensiles' => $ustensiles,
        ]);
    }
}
