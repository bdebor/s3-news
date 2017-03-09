<?php

namespace AppBundle\Controller\admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAction()
    {
        return $this->render(':admin/home:index.html.twig');
    }
}
