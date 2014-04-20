<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Description of Inmueble
 *
 * @author Sinue Yanez
 */
class Inmueble extends BienesRaicesAppModel{
    
    public $belongsTo = array(
        'Zona' => array(
            'className'=>'BienesRaices.Zona',
            'foreignKey' => 'zonas_id'
        ),
        'TipoInmueble' => array(
            'className' => 'BienesRaices.TipoInmueble',
            'foreignKey' => 'tipo_inmuebles_id'
        ),
        'TipoNegocio' => array(
            'className' => 'BienesRaices.TipoNegocio',
            'foreignKey' => 'tipo_negocios_id'
        )
    );
    
    public $hasMany = array(
        'InmuebleFoto' => array(
            'className' => 'BienesRaices.InmuebleFoto',
            'foreignKey' => 'inmuebles_id'
        )
    );
    
    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);
        $temp_folder = new Folder(BIENES_RAICES_FOTOS_TMP_PATH,true);
        $folder = new Folder(BIENES_RAICES_FOTOS_PATH,true);
        //$this->log(print_r($this->data,1),LOG_DEBUG);
        if(isset($this->data['InmuebleFoto']) && !empty($this->data['InmuebleFoto'])){
            $data = array(
                'InmuebleFoto' => array(
                    'inmuebles_id' => $this->id
                )
            );
            foreach($this->data['InmuebleFoto'] as $row){
                $data['InmuebleFoto']['nombre'] = $row['nombre'];
                $data['InmuebleFoto']['archivo'] = $row['archivo'];
                $this->InmuebleFoto->create();
                if($this->InmuebleFoto->save($data)){
                    $tmp_foto = new File($temp_folder->pwd().DS.$row['archivo']);
                    if(!$tmp_foto->copy($folder->pwd().DS.$row['archivo'])){                        
                        $this->InmuebleFoto->delete();
                    }
                    $tmp_foto->delete();
                }
            }
        }
    }
}
