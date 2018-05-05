<?php
/**
 * Created by PhpStorm.
 * User: sebmiet
 * Date: 12.04.18
 * Time: 23:44
 */

namespace App\Controller;


use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{

    /**
     * @Route("/", name = "home")
     */
    public function homepage()
    {

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        //Sortowanie wpisów po dacie publikacji od najstarszego do najnowszego
       usort( $articles, function( Article $a, Article $b ){
            if ( $a->getPostDate() == $b->getPostDate())
            {
                return 0;
            }
            else
            {
                return ( $a->getPostDate() < $b->getPostDate()) ? 1 : -1;
            }
        });


        return $this->render('blog/blog.html.twig', ['articles' => $articles, 'datePolish' => $this->dateMonthPolish() ]);
    }


    /**
     * @param $id
     * @Route("/blog/{id}-{title}", name = "article")
     */
    public function showPost($id)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $article = $repository->find($id);

        //Ustawienie poprawnie zapisanej nazwy miesiąca w języku polskim,
        $date = $article->getPostDate();
        $monthPolish = $this->dateMonthPolish($date->format("m"));

        return $this->render('blog/article.html.twig', ['article' => $article, 'monthPolish' => $monthPolish]);
    }



    public function dateMonthPolish($mth = null)
    {
        $month = array ('01' => 'stycznia', '02' => 'lutego', '03' => 'marca', '04' => 'kwietnia',
                        '05' => 'maja', '06' => 'czerwca', '07' => 'lipca', '08' => 'sierpnia',
                        '09' => 'września', '10' => 'października', '11' => 'listopada', '12' => 'grudnia');

        if ($mth == null) {
            return $month;
        } else {
            return $month[$mth];
        }
    }



}