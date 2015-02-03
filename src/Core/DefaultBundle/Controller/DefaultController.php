<?php

namespace Core\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('home');
        return $this->render('CoreDefaultBundle:Default:index.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'menuActive' => $activeMenu
        ));
    }

    public function descargasAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('descargas');
        return $this->render('CoreDefaultBundle:Default:descargas.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'menuActive' => $activeMenu
        ));
    }

    public function manualesAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('manuales');
        return $this->render('CoreDefaultBundle:Default:manuales.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'menuActive' => $activeMenu
        ));
    }

    public function involucrarseAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('involucrarse');
        return $this->render('CoreDefaultBundle:Default:involucrarse.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'menuActive' => $activeMenu
        ));
    }

    public function catalogoAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('catalogo');
        return $this->render('CoreDefaultBundle:Default:catalogo.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'menuActive' => $activeMenu
        ));
    }

    public function documentacionAction($project) {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('documentacion');
        return $this->render('CoreDefaultBundle:Default:documentacion.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'project' => $project,
                    'menuActive' => $activeMenu
        ));
    }

    public function viewdocAction($project, $type, $name) {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $urlDoc = '/documentation/' . $project . '/' . $type . '/' . $name . '/index.html';
        $activeMenu = $this->getClassMenuActive('documentacion');
        return $this->render('CoreDefaultBundle:Default:viewdoc.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'project' => $project,
                    'type' => $type,
                    'urlDoc' => $urlDoc,
                    'menuActive' => $activeMenu
        ));
    }

    public function buscarAction() {
        $em = $this->getDoctrine()->getManager();
//        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
//        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
//        return $this->render('CoreDefaultBundle:Default:involucrarse.html.twig', array(
//                    'theme' => $objTheme->getChrValue(),
//                    'siteName' => $objSite->getChrValue()
//        ));
    }

    private function getClassMenuActive($menu) {
        $arrayMenu = array(
            'descargas' => '',
            'manuales' => '',
            'involucrarse' => '',
            'catalogo' => '',
            'documentacion' => ''
        );
        foreach ($arrayMenu as $index => $strMenu) {
            if ($menu == $index) {
                $arrayMenu[$index] = 'active';
                break;
            }
        }
        return $arrayMenu;
    }

    public function vd($var) {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }

}
