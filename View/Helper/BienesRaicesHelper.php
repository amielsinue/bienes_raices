<?php

/* SYMDev */

/**
 * Description of BienesRaicesHelper
 *
 * @author Sinue Yanez
 */
class BienesRaicesHelper extends AppHelper{
    
    public $helpers = array('Html','BienesRaices.Mapa','BienesRaices.Fotos');
    
    public function thumb($InmuebleFotos = array(),$options = array()){        
        $archivo = !empty($InmuebleFotos) && isset($InmuebleFotos[0]) ? $InmuebleFotos[0]['archivo']: '';          
        return $this->Fotos->thumb($archivo,$options);
    }
    
    public function thumbs($InmuebleFotos = array(),$options = array()){
        $thumbs = '';
        if(!empty($InmuebleFotos)){
            foreach($InmuebleFotos as $foto){
                $thumbs .= $this->Fotos->thumb($foto['archivo'],$options);
            }
        }
        return $thumbs;
    }
    
    public function javascriptSelects($modelo){
        $paises_id = $estados_id = $ciudades_id = $zonas_id = 0;
        $data = (!empty($this->request->data))?$this->request->data : array();
        
        if(isset($data[$modelo]['paises_id']))
            $paises_id = $data[$modelo]['paises_id'];
        if(isset($data[$modelo]['estados_id']))
            $estados_id = $data[$modelo]['estados_id'];
        if(isset($data[$modelo]['ciudades_id']))
            $ciudades_id = $data[$modelo]['ciudades_id'];
        if(isset($data[$modelo]['zonas_id']))
            $zonas_id = $data[$modelo]['zonas_id'];
        
        
        $paises_url = $this->Html->url(array(
                'controller' => 'paises',
                'action' => 'select',
                'plugin' => 'bienes_raices',
                $paises_id
            ));
        $estados_url = $this->Html->url(array(
                'controller' => 'estados',
                'action' => 'select',
                'plugin' => 'bienes_raices'
            ));
        $ciudades_url = $this->Html->url(array(
                        'controller' => 'ciudades',
                        'action' => 'select',
                        'plugin' => 'bienes_raices'
                    ));
        $zonas_url = $this->Html->url(array(
                        'controller' => 'zonas',
                        'action' => 'select',
                        'plugin' => 'bienes_raices'
                    ));
        
        ?>
        <script type="text/javascript">
        if(typeof $ != 'undefined'){
            $(document).ready(function(){
                <?php if(!empty($data)):?>
                $('#<?=$modelo?>EstadosContenedor select').load('<?=$estados_url.'/'.$paises_id.'/'.$estados_id?>');
                $('#<?=$modelo?>CiudadesContenedor select').load('<?=$ciudades_url.'/'.$estados_id.'/'.$ciudades_id?>');
                $('#<?=$modelo?>ZonasContenedor select').load('<?=$zonas_url.'/'.$ciudades_id.'/'.$zonas_id?>');
                <?php endif;?>
                
                $('#<?=$modelo?>PaisesId').on('change',function(e){
                    var paises_id = $(e.currentTarget).val();            
                    var url = '<?=$estados_url?>';
                    url += '/'+paises_id;
                    $('#<?=$modelo?>EstadosContenedor select').load(url);
                    $('#<?=$modelo?>EstadosContenedor select').html('<option><?=__('Cargando')?></option>');
                    $('#<?=$modelo?>EstadosId').val('');
                    $('#<?=$modelo?>CiudadesId').val('');
                    $('#<?=$modelo?>ZonasId').val('');
                });
                $('#<?=$modelo?>EstadosId').on('change',function(e){
                    var paises_id = $(e.currentTarget).val();
                    var url = '<?=$ciudades_url?>';
                    url += '/'+paises_id;
                    $('#<?=$modelo?>CiudadesContenedor select').load(url);
                    $('#<?=$modelo?>CiudadesContenedor select').html('<option><?=__('Cargando')?></option>');
                    $('#<?=$modelo?>CiudadesId').val('');
                    $('#<?=$modelo?>ZonasId').val('');
                });
                $('#<?=$modelo?>CiudadesId').on('change',function(e){
                    var paises_id = $(e.currentTarget).val();
                    var url = '<?=$zonas_url?>';
                    url += '/'+paises_id;
                    $('#<?=$modelo?>ZonasContenedor select').load(url);
                    $('#<?=$modelo?>ZonasContenedor select').html('<option><?=__('Cargando')?></option>')
                    $('#<?=$modelo?>ZonasId').val('');
                });
                $('#<?=$modelo?>PaisesId').load('<?=$paises_url?>');
            });
        }    
        </script>
        <?php
    }
}
