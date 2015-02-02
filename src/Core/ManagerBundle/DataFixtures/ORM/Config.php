<?php
// src/Core/SecurityBundle/DataFixtures/ORM/Configss.php
namespace Core\SecurityBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\ManagerBundle\Entity\Config;

class Configs implements FixtureInterface{
    public function load(ObjectManager $manager) {
        $configurations = array(
            array('chr_name'=>'siteNameSmall','chr_value'=>'PD','bool_active'=>1),
            array('chr_name'=>'siteNameLarge','chr_value'=>'Project documentor 0.1','bool_active'=>1),
            array('chr_name'=>'Theme','chr_value'=>'Default','bool_active'=>1),
        );
        foreach($configurations as $configs){
            $objConfig = new Config();
            $objConfig->setChrName($configs['chr_name']);
            $objConfig->setChrValue($configs['chr_value']);
            $objConfig->setIsActive($configs['bool_active']);
            $manager->persist($objConfig);
        }
        $manager->flush();
        //$this->addReference('config', $objConfig);
    }
    
    public function getOrder(){
        return 1;
    }
}