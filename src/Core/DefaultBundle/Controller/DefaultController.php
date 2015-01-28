<?php

namespace Core\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName'=>'Theme', 'isActive'=>1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName'=>'siteNameLarge', 'isActive'=>1));
        return $this->render('CoreDefaultBundle:Default:index.html.twig', array(
            'theme'=>$objTheme->getChrValue(),
            'siteName'=>$objSite->getChrValue()
        ));
    }
    
    public function vd($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}
