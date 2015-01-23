<?php

namespace Theme\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ThemeDefaultBundle:Default:index.html.twig', array('name' => $name));
    }
}
