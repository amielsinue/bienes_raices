<h3><?=__('Ciudades')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table class="table table-bordered table-stripped">
    <thead>
    <th>TIID</th>
    <th><?=__('Nombre')?></th>    
    <th><?=__('Estado')?></th>
    <th><?=__('Pais')?></th>
    <th><?=__('Descripcion')?></th>
    <th></th>
    </thead>
    <tbody>
        <?php if(!empty($data)): foreach($data as $row):?>
        <tr>
            <td><?=$row['Ciudad']['id']?></td>
            <td><?=$row['Ciudad']['nombre']?></td>
            <td><?=$row['Estado']['nombre']?></td>
            <td><?=$paisesId[$row['Estado']['paises_id']]?></td>
            <td><?=$row['Ciudad']['descripcion']?></td>
            <td>
                <?=$this->Html->link(__('editar'),'editar/'.$row['Ciudad']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['Ciudad']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['Ciudad']['nombre']))?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>