<?php

/* SYMDev */

/**
 * Description of Zona
 *
 * @author Sinue Yanez
 */
class Zona extends BienesRaicesAppModel{
    
    public $belongsTo = array(
        'Ciudad' => array(
            'className' => 'BienesRaices.Ciudad',
            'foreignKey' => 'ciudades_id'
        )
    );
     public function lista($ciudades_id = 0){
        $options = array(
            'conditions' => array(),
            'fields' => array(
                'Zona.id',
                'Zona.nombre'
            )
        );
        if($paises_id > 0){
            $options['conditions']['Zona.ciudades_id'] = $ciudades_id;
        }
        return $this->find('list',$options);
    }
    public function arbolRetro($zonas_id = 0){
        $sql = 'SELECT
            `Zona`.`id`,
            `Zona`.`nombre`,
            `Ciudad`.`nombre` as `ciudad`,
            `Ciudad`.`id` as `ciudades_id`,
            `Estado`.`nombre` as `estado`,
            `Estado`.`id` as `estados_id`,
            `Pais`.`nombre` as `pais`,
            `Pais`.`id` as `paises_id`
          FROM
            `zonas` as `Zona`
          LEFT JOIN
            `ciudades` as `Ciudad` ON `Zona`.`ciudades_id` = `Ciudad`.`id`
          LEFT JOIN
            `estados` as `Estado` ON `Ciudad`.`estados_id` = `Estado`.`id`
          LEFT JOIN
            `paises` as `Pais` ON `Estado`.`paises_id` = `Pais`.`id`
        ';
        if($zonas_id > 0){
            $sql .= ' WHERE `Zona`.`id` = '.$zonas_id;
        }
        $data = $this->query($sql);        
        $arbol = array();
        if(!empty($data)):foreach($data as $row):
            $arbol[$row['Zona']['id']] = array(
                'id' => $row['Zona']['id'],
                'nombre' => $row['Zona']['nombre'],
                'ciudad' => $row['Ciudad']['ciudad'],
                'ciudades_id' => $row['Ciudad']['ciudades_id'],
                'estado' => $row['Estado']['estado'],
                'estados_id' => $row['Estado']['estados_id'],
                'pais' => $row['Pais']['pais'],
                'paises_id' => $row['Pais']['paises_id'],
            );
        endforeach;endif;
        if($zonas_id > 0){
            $arbol = current($arbol);
        }
        return $arbol;
    }        
}
