<?php

namespace Core\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreDefaultBundle:Default:index.html.twig');
    }
}
