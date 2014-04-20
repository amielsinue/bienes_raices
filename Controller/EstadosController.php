<?php

/* SYMDev */

/**
 * Description of EstadosController
 *
 * @author Sinue Yanez
 */
class EstadosController extends BienesRaicesAppController{
    
    public $uses = array('BienesRaices.Estado');
    
    public function admin_index(){
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Estado.nombre'=>'asc'
            )
        );                
        $this->set('data',$this->paginate($this->Estado));
    }
    
    public function admin_nuevo(){
        if(!empty($this->data)){
            if($this->Estado->save($this->data)){
                $this->Session->setFlash(__('Datos guardados correctamente'),'default',array('class'=>'success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Error al intentar guardar los datos'),'default',array('class'=>'error'));
            }
        }                
    }
    
    public function admin_editar($id){        
        if(!$this->Estado->exists($id)){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
        }
        $this->Estado->id = $id;
        if(!empty($this->data)){
            if($this->Estado->save($this->data)){
                $this->Session->setFlash(__('Datos actualizados correctamente'),'default',array('class'=>'success'));
                $this->request->data = $this->Estado->read();
            }else{
                $this->Session->setFlash(__('Error al intentar actualizar los datos'),'default',array('class'=>'error'));
            }
        }else{
            $this->request->data = $this->Estado->read();
        }        
    }
    
    public function admin_eliminar(){
        if(!$this->request->is('POST')){
            $this->Session->setFlash(__('Peticion invalida'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $id = $this->data['id'];
        if(!$this->Estado->exists($id) ){
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
            $this->Estado->id = $id;
            if($this->Estado->delete()){
                $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
            }else{
                $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
            }
        }
        $this->redirect($this->referer());        
    }
    
    public function admin_select($paises_id,$estados_id = 0){
        $this->select($paises_id,$estados_id);
        $this->render('select');
    }    
    
    /**
     * 
     */
    public function select($paises_id,$estados_id=0){
        $data = array();
        if($paises_id != 0){
            $data = $this->Estado->lista($paises_id);
        }
        $this->set('data',$data);
        $this->set('estados_id',$estados_id);
    }
}
