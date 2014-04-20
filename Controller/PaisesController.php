<?php

/* SYMDev */

/**
 * Description of PaisesController
 *
 * @author Sinue Yanez
 */
class PaisesController extends BienesRaicesAppController{
    
    public $uses = array('BienesRaices.Pais');
    
    public function admin_index(){
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Pais.nombre'=>'asc'
            )
        );        
        $this->set('data',$this->paginate($this->Pais));
    }
    
    public function admin_nuevo(){
        if(!empty($this->data)){
            if($this->Pais->save($this->data)){
                $this->Session->setFlash(__('Datos guardados correctamente'),'default',array('class'=>'success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Error al intentar guardar los datos'),'default',array('class'=>'error'));
            }
        }        
    }
    
    public function admin_editar($id){        
        if(!$this->Pais->exists($id)){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
        }
        $this->Pais->id = $id;
        if(!empty($this->data)){
            if($this->Pais->save($this->data)){
                $this->Session->setFlash(__('Datos actualizados correctamente'),'default',array('class'=>'success'));
                $this->request->data = $this->Pais->read();
            }else{
                $this->Session->setFlash(__('Error al intentar actualizar los datos'),'default',array('class'=>'error'));
            }
        }else{
            $this->request->data = $this->Pais->read();
        }
    }
    
    public function admin_eliminar(){
        if(!$this->request->is('POST')){
            $this->Session->setFlash(__('Peticion invalida'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $id = $this->data['id'];
        if(!$this->Pais->exists($id) ){
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
            $this->Pais->id = $id;
            if($this->Pais->delete()){
                $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
            }else{
                $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
            }
        }
        $this->redirect($this->referer());        
    }
    public function admin_select($paises_id=0){
        $this->select($paises_id);
        $this->render('select');
    }    
    
    /**
     * 
     */
    public function select($paises_id=0){
        $data = array();        
        $data = $this->Pais->lista();        
        $this->set('data',$data);
        $this->set('paises_id',$paises_id);
    }
}
