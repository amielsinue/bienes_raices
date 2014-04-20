<?php

/* SYMDev */

/**
 * Description of ZonasController
 *
 * @author Sinue Yanez
 */
class ZonasController extends BienesRaicesAppController{
    
    public $uses = array('BienesRaices.Zona','BienesRaices.Estado','BienesRaices.Pais');
    
    public function admin_index(){
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Zona.nombre'=>'asc'
            )
        );          
        $this->set('paises',$this->Pais->find('all'));
        $this->set('data',$this->paginate($this->Zona));
        $this->set('estadosId',$this->Estado->lista());
    }
    
    public function admin_nuevo(){
        if(!empty($this->data)){
            if($this->Zona->save($this->data)){
                $this->Session->setFlash(__('Datos guardados correctamente'),'default',array('class'=>'success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Error al intentar guardar los datos'),'default',array('class'=>'error'));
            }
        }                
    }
    
    public function admin_editar($id){        
        if(!$this->Zona->exists($id)){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
        }
        $this->Zona->id = $id;
        if(!empty($this->data)){
            if($this->Zona->save($this->data)){
                $this->Session->setFlash(__('Datos actualizados correctamente'),'default',array('class'=>'success'));
                $this->request->data = $this->Zona->read();
            }else{
                $this->Session->setFlash(__('Error al intentar actualizar los datos'),'default',array('class'=>'error'));
            }
        }else{
            $this->request->data = $this->Zona->read();
        }
        $zona_info = $this->Zona->arbolRetro($id);
        $this->request->data['Zona']['paises_id'] = $zona_info['paises_id'];
        $this->request->data['Zona']['estados_id'] = $zona_info['estados_id'];
        $this->request->data['Zona']['ciudades_id'] = $zona_info['ciudades_id'];
        //debug($zona_info);
    }
    
    public function admin_eliminar(){
        if(!$this->request->is('POST')){
            $this->Session->setFlash(__('Peticion invalida'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $id = $this->data['id'];
        if(!$this->Zona->exists($id) ){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        #TODO: Add validation when it has inmuebles associated
        if(false){
            $this->Session->setFlash(
                    __('No es posible eliminar este registro').':'.
                    __('Cuenta con inmuebles asociados'),
                    'default',array('class'=>'error'));
        }else{
            $this->Zona->id = $id;
            if($this->Zona->delete()){
                $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
            }else{
                $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
            }
        }
        $this->redirect($this->referer());        
    }
    
    public function admin_select($ciudades_id,$zonas_id=0){
        $this->select($ciudades_id,$zonas_id);
        $this->render('select');
    }    
    
    /**
     * 
     */
    public function select($ciudades_id,$zonas_id=0){
        $data = array();
        if($ciudades_id != 0){
            $data = $this->Zona->lista($ciudades_id);
        }
        $this->set('data',$data);
        $this->set('zonas_id',$zonas_id);
    }
}
