<?php

/* SYMDev */

/**
 * Description of BienesRaicesAppModel
 *
 * @author Sinue Yanez
 */
class BienesRaicesAppModel extends AppModel{
    //put your code here
    
    public $listaFields = array(
        'id',
        'nombre',
    );
    
    public $plugin = 'BienesRaices';
    
    public function lista(){
        $fields = array(
            $this->name.'.'.$this->listaFields[0],
            $this->name.'.'.$this->listaFields[1]
        );
        return $this->find('list',array(
            'fields' => $fields
        ));
    }
}
