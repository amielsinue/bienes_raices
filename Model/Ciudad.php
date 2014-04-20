<?php

/* SYMDev */

/**
 * Description of Ciudad
 *
 * @author Sinue Yanez
 */
class Ciudad extends BienesRaicesAppModel{
    
    public $useTable = 'ciudades';
    
    public $belongsTo = array(
        'Estado' => array(
            'className' => 'BienesRaices.Estado',
            'foreignKey' => 'estados_id'
        )
    );
    public $hasMany = array(
        'Zona' => array(
            'className' => 'BienesRaices.Zona',
            'foreignKey' => 'ciudades_id'
        )
    );
    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);
        # TODO: apply validation to allow the same name in other cities
        $this->validate = array(
           'nombre' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            )
        );
    }     
    public function lista($estados_id = 0){
        $options = array(
            'conditions' => array(),
            'fields' => array(
                'Ciudad.id',
                'Ciudad.nombre'
            )
        );
        if($estados_id > 0){
            $options['conditions']['Ciudad.estados_id'] = $estados_id;
        }
        return $this->find('list',$options);
    }    
}
