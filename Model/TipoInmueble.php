<?php

/* SYMDev */

/**
 * Description of TipoInmueble
 *
 * @author Sinue Yanez
 */
class TipoInmueble extends BienesRaicesAppModel{
    
    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);
        $this->validate = array(
            'nombre' => array(
                'rule' => 'isUnique',
                'message' => __('Este registro ya existe en el sistema, verifique')
            )
        );
    }
}
