<?=$this->Form->create()?>
<table>
    <tr>
        <td><?=__('Nombre')?></td>
        <td><?=$this->Form->input('nombre',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('Pais')?></td>
        <td><?=$this->Form->input('paises_id',array(
            'label' => false,            
        ))?></td>
    </tr>
    <tr>
        <td><?=__('Estado')?></td>
        <td id="ZonaEstadosContenedor"><?=$this->Form->input('estados_id',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('Ciudad')?></td>
        <td id="ZonaCiudadesContenedor"><?=$this->Form->input('ciudades_id',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('Descripcion')?></td>
        <td><?=$this->Form->input('descripcion',array('label' => false,'type'=>'textarea'))?></td>
    </tr>
</table>
<?=$this->Form->end(__('Guardar'))?>
<?php $this->BienesRaices->javascriptSelects('Zona');?>