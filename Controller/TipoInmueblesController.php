<?php

/* SYMDev */

/**
 * Description of TipoInmueblesController
 *
 * @author Sinue Yanez
 */
class TipoInmueblesController extends BienesRaicesAppController{
    
    public function admin_index(){
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'TipoInmueble.nombre'=>'asc'
            )
        );
        
        $this->set('data',$this->paginate($this->TipoInmueble));
    }
    
    public function admin_nuevo(){
        if(!empty($this->data)){
            if($this->TipoInmueble->save($this->data)){
                $this->Session->setFlash(__('Datos guardados correctamente'),'default',array('class'=>'success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Error al intentar guardar los datos'),'default',array('class'=>'error'));
            }
        }        
    }
    
    public function admin_editar($id){        
        if(!$this->TipoInmueble->exists($id)){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
        }
        $this->TipoInmueble->id = $id;
        if(!empty($this->data)){
            if($this->TipoInmueble->save($this->data)){
                $this->Session->setFlash(__('Datos actualizados correctamente'),'default',array('class'=>'success'));
                $this->request->data = $this->TipoInmueble->read();
            }else{
                $this->Session->setFlash(__('Error al intentar actualizar los datos'),'default',array('class'=>'error'));
            }
        }else{
            $this->request->data = $this->TipoInmueble->read();
        }
    }
    
    public function admin_eliminar(){
        if(!$this->request->is('POST')){
            $this->Session->setFlash(__('Peticion invalida'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $id = $this->data['id'];
        if(!$this->TipoInmueble->exists($id) ){
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
            $this->TipoInmueble->id = $id;
            if($this->TipoInmueble->delete()){
                $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
            }else{
                $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
            }
        }
        $this->redirect($this->referer());        
    }
}
