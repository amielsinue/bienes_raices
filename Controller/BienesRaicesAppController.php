<?php

/* SYMDev */
require_once APP.'Plugin'.DS.'BienesRaices'.DS.'Config'.DS.'config.php';
/**
 * Description of BienesRaicesController
 *
 * @author Sinue Yanez
 */
class BienesRaicesAppController extends AppController{
    
    public $uses = array();
    
    public $components = array(
        'RequestHandler'
    );
    
    public $helpers = array(
        'BienesRaices.BienesRaices',
        'BienesRaices.Mapa'
    );
    
    public function index(){
        
    }
    
}
