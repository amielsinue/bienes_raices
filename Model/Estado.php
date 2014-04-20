<?php

/* SYMDev */

/**
 * Description of Estado
 *
 * @author Sinue Yanez
 */
class Estado extends BienesRaicesAppModel{
    
    public $belongsTo = array(
        'Pais' => array(
            'className' => 'BienesRaices.Pais',
            'foreignKey' => 'paises_id',            
        )
    );
    
    public $hasMany = array(
        'Ciudad' => array(
            'className' => 'BienesRaices.Ciudad',
            'foreignKey' => 'estados_id'
        )
    );
    
    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);
        # TODO: apply validation to allow the same name in other countries
        $this->validate = array(
           'nombre' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            )
        );
    }      
    
    public function lista($paises_id = 0){
        $options = array(
            'conditions' => array(),
            'fields' => array(
                'Estado.id',
                'Estado.nombre'
            )
        );
        if($paises_id > 0){
            $options['conditions']['Estado.paises_id'] = $paises_id;
        }
        return $this->find('list',$options);
    }
}
