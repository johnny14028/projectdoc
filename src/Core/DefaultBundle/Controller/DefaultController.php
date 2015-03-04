<?php

namespace Core\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('home');
        $projects = $this->getProject();
        return $this->render('CoreDefaultBundle:Default:index.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'projects' => $projects,
                    'menuActive' => $activeMenu
        ));
    }

    public function descargasAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('descargas');
        $projects = $this->getProject();
        return $this->render('CoreDefaultBundle:Default:descargas.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'projects' => $projects,
                    'menuActive' => $activeMenu
        ));
    }

    public function manualesAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('manuales');
        $projects = $this->getProject();
        return $this->render('CoreDefaultBundle:Default:manuales.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'projects' => $projects,
                    'menuActive' => $activeMenu
        ));
    }

    public function involucrarseAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('involucrarse');
        $projects = $this->getProject();
        return $this->render('CoreDefaultBundle:Default:involucrarse.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'projects' => $projects,
                    'menuActive' => $activeMenu
        ));
    }

    public function catalogoAction() {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('catalogo');
        $projects = $this->getProject();
        return $this->render('CoreDefaultBundle:Default:catalogo.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'projects' => $projects,
                    'menuActive' => $activeMenu
        ));
    }

    public function documentacionAction($project) {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('documentacion');
        $projects = $this->getProject();
        $subprojects = $this->getProject($project);
        if (is_array($subprojects) && count($subprojects) > 0) {
            foreach ($subprojects as $indice => $subproject) {
                $subproject['plugin'] = $this->getProject($project . '/' . $subproject['name']);
                $subprojects[$indice] = $subproject;
            }
        }
        return $this->render('CoreDefaultBundle:Default:documentacion.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'project' => $project,
                    'projects' => $projects,
                    'menuActive' => $activeMenu,
                    'subprojects' => $subprojects
        ));
    }

    public function viewdocAction($project, $type, $name) {
        $em = $this->getDoctrine()->getManager();
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $urlDoc = '/documentation/' . $project . '/' . $type . '/' . $name . '/index.html';
        $activeMenu = $this->getClassMenuActive('documentacion');
        $projects = $this->getProject();
        return $this->render('CoreDefaultBundle:Default:viewdoc.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'project' => $project,
                    'type' => $type,
                    'urlDoc' => $urlDoc,
                    'projects' => $projects,
                    'menuActive' => $activeMenu
        ));
    }

    public function buscarAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $buscar = $request->request->get('txtBuscar');
        //obtenemos los proyectos
        $projects = $this->getProject();
        $pathDoc = $this->container->get('kernel')->getRootdir() . '/../web/documentation';
        $cmd = "find " . $pathDoc . " | xargs grep '" . $buscar . "' -sl";
        //iteramos los proyectos
        $arrayProject = array();
        $arrayResultFind = array();
        foreach ($projects as $index => $project) {
            //$pathProject = $pathDoc.'/'.$project['name'];
            $project['plugin'] = $subprojects = $this->getProject($project['name']);
            foreach ($subprojects as $indice => $subproject) {
                $arrayTemp = array();
                $arrayTemp['project'] = $project['name'];
                $arrayTemp['type'] = $subproject['name'];

                //iteramos los plugins
                $pathPlugin = $_SERVER['DOCUMENT_ROOT'] . '/documentation/' . $project['name'] . '/' . $subproject['name'] . '/*';
                foreach (glob($pathPlugin) as $pathP) {
                    $strRutas = explode('/', $pathP);
                    $arrayResult = array();
                    $pathFiles = $pathP . '/files';
                    $cmdF = "find " . $pathFiles . " | xargs grep '" . $buscar . "' -sl";
                    $outputConsoleF = shell_exec($cmdF);
                    $outputConsoleF = explode("\n", $outputConsoleF);
                    //cremos un array unico
                    if (is_array($outputConsoleF) && count($outputConsoleF) > 0) {
                        foreach ($outputConsoleF as $indice => $file) {
                            if (strlen(trim($file)) > 0) {
                                $array['project'] = $project['name'];
                                $array['type'] = $subproject['name'];
                                $array['plugin'] = $strRutas[count($strRutas)-1];
                                $array['file'] = $file;
                                $array['url'] = '/documentacion/'.$project['name'].'/'.$subproject['name'].'/'.$strRutas[count($strRutas)-1];
                                $file_public = explode("/", $file);
                                foreach($file_public as $ind=>$f){
                                    if($f=='documentation'){
                                        break;
                                    }else{
                                        unset($file_public[$ind]);
                                    }
                                }
                                $array['file_public'] = implode('/',$file_public);
                                array_push($arrayResultFind, $array);
                            }
                        }
                    }
                    $arrayResult = array_merge($arrayResult, $outputConsoleF);

                    $pathClass = $pathP . '/classes';
                    $cmdC = "find " . $pathClass . " | xargs grep '" . $buscar . "' -sl";
                    $outputConsoleC = shell_exec($cmdC);
                    $outputConsoleC = explode("\n", $outputConsoleC);
                    $arrayResult = array_merge($arrayResult, $outputConsoleC);

                    $pathNamespaces = $pathP . '/namespaces';
                    $cmdN = "find " . $pathNamespaces . " | xargs grep '" . $buscar . "' -sl";
                    $outputConsoleN = shell_exec($cmdN);
                    $outputConsoleN = explode("\n", $outputConsoleN);
                    $arrayResult = array_merge($arrayResult, $outputConsoleN);


                    $arrayTemp['plugin'] = array_pop($strRutas);
                    $arrayTemp['result'] = $arrayResult;
                    array_push($arrayProject, $arrayTemp);
                }
            }
            $projects[$index] = $project;
        }
        $objTheme = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'Theme', 'isActive' => 1));
        //obtenemos ĺa configuración
        $objSite = $em->getRepository('CoreManagerBundle:Config')->findOneBy(array('chrName' => 'siteNameLarge', 'isActive' => 1));
        $activeMenu = $this->getClassMenuActive('home');
        return $this->render('CoreDefaultBundle:Default:buscar.html.twig', array(
                    'theme' => $objTheme->getChrValue(),
                    'siteName' => $objSite->getChrValue(),
                    'menuActive' => $activeMenu,
                    'projects' => $projects,
                    'result' => $arrayResultFind
        ));
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

    private function getProject($project = '') {
        $returnValue = array();
        if (strlen(trim($project)) > 0) {
            $project = $project . '/';
        }
        $pathDoc = $this->container->get('kernel')->getRootdir() . '/../web/documentation/' . $project . '*';
        foreach (glob($pathDoc) as $pathProject) {
            if (is_dir($pathProject)) {
                $arrayProject['path'] = $pathProject;
                $strRutas = explode('/', $pathProject);
                $arrayProject['name'] = array_pop($strRutas);
            }
            array_push($returnValue, $arrayProject);
        }
        return $returnValue;
    }

    public function vd($var) {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }

}
