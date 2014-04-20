<?php

/* SYMDev */

/**
 * Description of CiudadesController
 *
 * @author Sinue Yanez
 */
class CiudadesController extends BienesRaicesAppController{
    
    public $uses = array('BienesRaices.Ciudad','BienesRaices.Pais');
    
    public function admin_index(){
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Ciudad.nombre'=>'asc'
            )
        );                
        $this->set('data',$this->paginate($this->Ciudad));
        $this->set('paisesId',$this->Pais->lista());
    }
    
    public function admin_nuevo(){
        if(!empty($this->data)){
            if($this->Ciudad->save($this->data)){
                $this->Session->setFlash(__('Datos guardados correctamente'),'default',array('class'=>'success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Error al intentar guardar los datos'),'default',array('class'=>'error'));
            }
        }                
    }
    
    public function admin_editar($id){        
        if(!$this->Ciudad->exists($id)){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
        }
        $this->Ciudad->id = $id;
        if(!empty($this->data)){
            if($this->Ciudad->save($this->data)){
                $this->Session->setFlash(__('Datos actualizados correctamente'),'default',array('class'=>'success'));
                $this->request->data = $this->Ciudad->read();
            }else{
                $this->Session->setFlash(__('Error al intentar actualizar los datos'),'default',array('class'=>'error'));
            }
        }else{
            $this->request->data = $this->Ciudad->read();
        }
        
        $this->Ciudad->Estado->id = $this->data['Ciudad']['estados_id'];
        $this->request->data['Ciudad']['paises_id'] = $this->Ciudad->Estado->field('paises_id');        
    }
    
    public function admin_eliminar(){
        if(!$this->request->is('POST')){
            $this->Session->setFlash(__('Peticion invalida'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $id = $this->data['id'];
        if(!$this->Ciudad->exists($id) ){
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
            $this->Ciudad->id = $id;
            if($this->Ciudad->delete()){
                $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
            }else{
                $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
            }
        }
        $this->redirect($this->referer());        
    }
    public function admin_select($estados_id,$ciudades_id=0){
        $this->select($estados_id,$ciudades_id);
        $this->render('select');
    }    
    
    /**
     * 
     */
    public function select($estados_id,$ciudades_id=0){
        $data = array();
        if($estados_id != 0){
            $data = $this->Ciudad->lista($estados_id);
        }
        $this->set('data',$data);
        $this->set('ciudades_id',$ciudades_id);
    }
}
