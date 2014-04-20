<?php

/* SYMDev */

/**
 * Description of Pais
 *
 * @author Sinue Yanez
 */
class Pais extends BienesRaicesAppModel{
    
    public $useTable  = 'paises';
    
    public $hasMany = array(
        'Estado' => array(
            'className' => 'BienesRaices.Estado',
            'foreignKey' => 'paises_id'
        )
    );
    
    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);
        $this->validate = array(
            'nombre' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            ),
            'isonombre' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            ),
            'iso2' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            ),
            'iso3' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            ),
            'codigo' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            )
        );
    }    
}
