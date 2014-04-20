<?php

/* SYMDev */

/**
 * Description of MapaHelper
 *
 * @author Sinue Yanez
 */
class MapaHelper extends AppHelper{
    
    protected $api_source = 'maps.google.com/maps/api/js?key={YOUR_API_KEY}&sensor=true';
    protected $app_source = 'mapa';
    protected $protocol_source = 'http';
    public $helpers = array('Html');
    
    protected $coordenadas='';
    
    public function init($coordenadasInputId,$mapaContenedorId,$readOnly = false){
        if($this->request->is('ssl'))
            $this->protocol_source = 'https';
        
        $this->Html->script($this->protocol_source.'://'.$this->api_source, false);
        $this->Html->script($this->webroot.'bienes_raices/js/'.$this->app_source, false);
        
        $this->Html->scriptStart();
        $provider = 'new Bienes_Raices.Mapa.Coordenadas("'.$coordenadasInputId.'")';        
        $adapter = 'new Bienes_Raices.Mapa.GooleAdapter("'.$mapaContenedorId.'",'.(($readOnly)?'true':'false').')';
        echo "var bienesRaicesMapa = new Bienes_Raices.Mapa($provider,$adapter);";
        if($this->coordenadas != ''){
            echo 'bienesRaicesMapa.adapter.setDefaultMarker('.$this->coordenadas.');';
        }
        echo $this->Html->scriptEnd();
    }
}
