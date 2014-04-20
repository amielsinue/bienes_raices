<?=$this->Form->create('Inmueble',array(
    'type' => 'file',
    'inputDefaults'=>array(
        'label' => false
    )
))?>
<table>
    <tr>
        <td><?=__('Pais')?></td>
        <td><?=$this->Form->input('paises_id',array(
            'empty' => 'Selecciona'            
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Estado')?></td>
        <td id="InmuebleEstadosContenedor"><?=$this->Form->input('estados_id',array(
            'empty' => 'Selecciona Pais'
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Ciudad')?></td>
        <td id="InmuebleCiudadesContenedor"><?=$this->Form->input('ciudades_id',array(
            'empty' => 'Selecciona Estado'
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Zonas')?></td>
        <td id="InmuebleZonasContenedor"><?=$this->Form->input('zonas_id',array(
            'empty' => 'Selecciona Ciudad'
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Tipo de Inmueble')?></td>
        <td><?=$this->Form->input('tipo_inmuebles_id',array(
            'options' => $tipoInmueblesId
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Tipo de Negocio')?></td>
        <td><?=$this->Form->input('tipo_negocios_id',array(
            'options' => $tipoNegociosId
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Codigo')?></td>
        <td><?=$this->Form->input('codigo')?></td>
    </tr>
    <tr>
        <td><?=__('Area construida')?></td>
        <td><?=$this->Form->input('area_construida')?></td>
    </tr>
    <tr>
        <td><?=__('Area Terreno')?></td>
        <td><?=$this->Form->input('area_terreno')?></td>
    </tr>
    <tr>
        <td><?=__('Habitaciones')?></td>
        <td><?=$this->Form->input('habitaciones')?></td>
    </tr>
    <tr>
        <td><?=__('Banos')?></td>
        <td><?=$this->Form->input('banos')?></td>
    </tr>
    <tr>
        <td><?=__('Garaje')?></td>
        <td><?=$this->Form->input('garaje')?></td>
    </tr>
    <tr>
        <td><?=__('Precio')?></td>
        <td><?=$this->Form->input('precio')?></td>
    </tr>
    <tr>
        <td><?=__('Otras Caracteristicas')?></td>
        <td><?=$this->Form->input('caracteristicas')?></td>
    </tr>
    <tr>
        <td><?=__('Descripcion')?></td>
        <td><?=$this->Form->input('descripcion')?></td>
    </tr>
    <tr>
        <td>Mapa</td>
        <td>
            <?=$this->Form->hidden('coordenadas')?>
            <div id="InmuebleMapaContenedor" style="width: 800px; height: 800px;"></div>
            <?php $this->Mapa->init('InmuebleCoordenadas','InmuebleMapaContenedor');?>
        </td>
    </tr>
    <tr>
        <td>Fotos</td>
        <td>    
            <div>
            <?=$this->Form->file('InmuebleFoto.upload')?>
            <?=$this->Fotos->uploadify('InmuebleFotoUpload',$this->Html->url(array(
                'controller' => 'inmueble_fotos',
                'action'    => 'pre_carga'
            )),array())?>
            </div>
            <div>
            <?php if(isset($this->data['InmuebleFoto'])):foreach($this->data['InmuebleFoto'] as $foto):?>
                <div style="float:left;margin:3px;">
                    <?=$this->Fotos->thumb($foto['archivo'],array(
                        'width'=>'200px',             
                        'alt' => $foto['nombre'],
                        'title' => $foto['nombre'],
                        'after' =>'<br/>'.$this->Html->link('Eliminar',array(
                            'controller' => 'inmueble_fotos',
                            'action'    => 'eliminar',
                            $foto['id']
                        ),null,__('Realmente deseas elminar esta foto: %s',$foto['nombre']))
                    ))?>                
                </div>
            <?php endforeach;endif;?>
            </div>
        </td>
    </tr>
</table>
<?=$this->Form->end('Guardar')?>
<?php
$this->BienesRaices->javascriptSelects('Inmueble');
?>
