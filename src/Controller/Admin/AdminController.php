<?php
/**
 * Created by PhpStorm.
 * User: sebmiet
 * Date: 27.04.18
 * Time: 18:52
 */

namespace App\Controller\Admin;


use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AdminController extends Controller
{
    /**
     * @Route("/adminpage", name="adminpage")
     */
    public function adminpage()
    {


        return $this->render('admin/admin.html.twig');
    }

    //funkcja dodania nowego artykułu
    /**
     * @Route("/adminpage/addarticle", name="addarticle")
     */
    public function addArticle(Request $request)
    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);


        $form->handleRequest($request);
        if  ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article', [
                'id' => $article->getId(), 'title' => $article->getTitle()]);
        }

        return $this->render('admin/addpost.html.twig', array('form' => $form->createView(), 'title' => 'Dodaj wpis'));

   }

   //funkcja edycji istniejącego artykułu.
    /**
     * @param $id
     * @Route("/adminpage/editarticle-{id}-{title}", name="editarticle")
     */
    public function editArticle($id, Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $article = $repository->find($id);

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if  ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article', [
                'id' => $article->getId(), 'title' => $article->getTitle()]);
        }

        return $this->render('admin/editarticle.html.twig', array('form' => $form->createView(), 'title' => 'Edytuj wpis'));

    }

    //Wyświetlenie listy artykułów w widoku administratora -> tabela
    /**
     * @Route("/adminpage/showarticles", name="showarticles")
     */
    public function showArticles()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('admin/showarticles.html.twig', ['articles' => $articles]);
    }

}