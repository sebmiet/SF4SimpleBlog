<?php
/**
 * Created by PhpStorm.
 * User: sebmiet
 * Date: 12.04.18
 * Time: 23:44
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return $this->render('blog/blog.html.twig');
    }
}