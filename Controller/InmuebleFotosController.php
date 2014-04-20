<?php

/* SYMDev */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Description of InmuebleFotosController
 *
 * @author Sinue Yanez
 */
class InmuebleFotosController extends BienesRaicesAppController{

    public function admin_pre_carga(){
        
        $temp_folder = new Folder(BIENES_RAICES_FOTOS_TMP_PATH, true);
        $this->layout = 'ajax';
        $nombre = 's/n';
        $archivo = 'vacio';

        if(!empty($_FILES) && $_FILES['Filedata']['error'] == UPLOAD_ERR_OK){
            $partes = explode('.',$_FILES['Filedata']['name']);
            $extension = end($partes);
            $nombre = $_FILES['Filedata']['name'];
            $archivo = md5($nombre.time()).'-'.uniqid().'.'.$extension;
            $temporal = new File($_FILES['Filedata']['tmp_name']);
            $temporal->copy($temp_folder->pwd().DS.$archivo);
        }

        $this->set(compact(array('nombre','archivo')));
    }
    
    public function admin_eliminar($id){
        
        $this->InmuebleFoto->id = $id;
        if(!$this->InmuebleFoto->exists()){
            $this->Session->setFlash(__('Registro no encontrado'),'default',array('class'=>'error'));
            $this->redirect($this->referer());
        }
        $data = $this->InmuebleFoto->read();
        $archivo = $data['InmuebleFoto']['archivo'];
        $foto = new File(BIENES_RAICES_FOTOS_PATH.$archivo);
        $eliminar = true;
        if($foto->exists()){
            $eliminar = $foto->delete();
        }
        
        if($eliminar && $this->InmuebleFoto->delete()){
            $this->Session->setFlash(__('Datos eliminados correctamente'),'default',array('class'=>'success'));
        }else{
            $this->Session->setFlash(__('No es posible eliminar este registro'),'default',array('class'=>'error'));
        }
        $this->redirect($this->referer());
    }
}
