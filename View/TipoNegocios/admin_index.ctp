<h3><?=__('Tipo de Negocios')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table class="table table-bordered table-stripped">
    <thead>
    <th>TNID</th>
    <th><?=__('Nombre')?></th>
    <th><?=__('Descripcion')?></th>
    <th></th>
    </thead>
    <tbody>
        <?php if(!empty($data)): foreach($data as $row):?>
        <tr>
            <td><?=$row['TipoNegocio']['id']?></td>
            <td><?=$row['TipoNegocio']['nombre']?></td>
            <td><?=$row['TipoNegocio']['descripcion']?></td>
            <td>
                <?=$this->Html->link(__('editar'),'editar/'.$row['TipoNegocio']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['TipoNegocio']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['TipoNegocio']['nombre']))?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>