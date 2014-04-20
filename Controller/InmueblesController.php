<?php

/* SYMDev */

/**
 * Description of InmueblesController
 *
 * @author Sinue Yanez
 */
class InmueblesController extends BienesRaicesAppController{
    
    public $uses = array(
        'BienesRaices.Inmueble',        
        'BienesRaices.Pais',        
        'BienesRaices.Ciudad',        
        'BienesRaices.Estado',        
    );
    
    public function beforeFilter() {
        parent::beforeFilter();        
    }
    
    public function admin_index(){
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Inmueble.created' => 'desc'
            )            
        );
        $this->set('data',$this->paginate($this->Inmueble));
        $this->set('zonas',$this->Inmueble->Zona->arbolRetro());             
    }
    
    public function admin_nuevo(){
        
        if(!empty($this->data)){
            if($this->Inmueble->save($this->data)){
                $this->Session->setFlash(__('Datos guardados correctamente'),'default',array('class'=>'success'));
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Error al intentar guardar los datos'),'default',array('class'=>'error'));
            }
        }        
        $this->set('tipoInmueblesId',$this->Inmueble->TipoInmueble->lista());
        $this->set('tipoNegociosId',$this->Inmueble->TipoNegocio->lista());
    }
    public function admin_editar($id){
        $this->Inmueble->id = $id;
        if(!empty($this->data)){
            if($this->Inmueble->save($this->data)){
                $this->Session->setFlash(__('Datos actualizados correctamente'),'default',array('class'=>'success'));
                $this->request->data = $this->Inmueble->read();
            }else{
                $this->Session->setFlash(__('Error al intentar actualizar los datos'),'default',array('class'=>'error'));
            }
        }else{
            $this->request->data = $this->Inmueble->read();
        }
                   
        $this->set('tipoInmueblesId',$this->Inmueble->TipoInmueble->lista());
        $this->set('tipoNegociosId',$this->Inmueble->TipoNegocio->lista());
        $zona_info = $this->Inmueble->Zona->arbolRetro($this->data['Inmueble']['zonas_id']);
        $this->request->data['Inmueble']['paises_id'] = $zona_info['paises_id'];
        $this->request->data['Inmueble']['estados_id'] = $zona_info['estados_id'];
        $this->request->data['Inmueble']['ciudades_id'] = $zona_info['ciudades_id'];
    }
    public function admin_ver($id){
        $this->Inmueble->id = $id;
        $data = $this->Inmueble->read();
        $zona_info = $this->Inmueble->Zona->arbolRetro($data['Inmueble']['zonas_id']);
        $data['Inmueble']['paises_id'] = $zona_info['paises_id'];
        $data['Inmueble']['paises_nombre'] = $zona_info['pais'];
        $data['Inmueble']['estados_id'] = $zona_info['estados_id'];
        $data['Inmueble']['estados_nombre'] = $zona_info['estado'];
        $data['Inmueble']['ciudades_id'] = $zona_info['ciudades_id'];
        $data['Inmueble']['ciudades_nombre'] = $zona_info['ciudad'];
        $this->set('data',$data);
    }
    public function admin_eliminar(){
        if(!$this->request->is('POST')){
            $this->Session->setFlash(__('Peticion invalida'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $id = $this->data['id'];
        if(!$this->Inmueble->exists($id) ){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $this->Inmueble->id = $id;
        if($this->Inmueble->delete()){
            #TODO: Remove pics after deletion
            $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
        }else{
            $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
        }
        $this->redirect($this->referer());        
    }
}
