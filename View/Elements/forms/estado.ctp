<?=$this->Form->create()?>
<table>
    <tr>
        <td><?=__('Nombre')?></td>
        <td><?=$this->Form->input('nombre',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('Pais')?></td>
        <td><?=$this->Form->input('paises_id',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('Descripcion')?></td>
        <td><?=$this->Form->input('descripcion',array('label' => false,'type'=>'textarea'))?></td>
    </tr>
</table>
<?=$this->Form->end(__('Guardar'))?>
<?php $this->BienesRaices->javascriptSelects('Estado');?>