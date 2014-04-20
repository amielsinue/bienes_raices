<h3><?=__('Estados')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table class="table table-bordered table-stripped">
    <thead>
    <th>TIID</th>
    <th><?=__('Nombre')?></th>
    <th><?=__('Pais')?></th>
    <th><?=__('Descripcion')?></th>
    <th></th>
    </thead>
    <tbody>
        <?php if(!empty($data)): foreach($data as $row):?>
        <tr>
            <td><?=$row['Estado']['id']?></td>
            <td><?=$row['Estado']['nombre']?></td>
            <td><?=$row['Pais']['nombre']?></td>
            <td><?=$row['Estado']['descripcion']?></td>
            <td>
                <?=$this->Html->link(__('editar'),'editar/'.$row['Estado']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['Estado']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['Estado']['nombre']))?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>