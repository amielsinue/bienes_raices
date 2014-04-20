<h3><?=__('Zonas')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table class="table table-bordered table-stripped">
    <thead>
    <th>TIID</th>
    <th><?=__('Nombre')?></th>    
    <th><?=__('Ciudad')?></th>
    <th><?=__('Estado')?></th>
    <th><?=__('Pais')?></th>
    <th><?=__('Descripcion')?></th>
    <th></th>
    </thead>
    <tbody>
        <?php if(!empty($data)): foreach($data as $row):?>
        <tr>
            <td><?=$row['Zona']['id']?></td>
            <td><?=$row['Zona']['nombre']?></td>
            <td><?=$row['Ciudad']['nombre']?></td>
            <td><?=$estadosId[$row['Ciudad']['estados_id']]?></td>
            <td>
                <?php if(!empty($paises)):foreach($paises as $pais):?>
                <?php if(!empty($pais['Estado'])): foreach($pais['Estado'] as $estado):if($estado['id'] != $row['Ciudad']['estados_id']) continue;?>
                <?php echo $pais['Pais']['nombre']?>
                <?php endforeach;endif;?>
                <?php endforeach;endif;?>
            </td>
            <td><?=$row['Zona']['descripcion']?></td>
            <td>
                <?=$this->Html->link(__('editar'),'editar/'.$row['Zona']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['Zona']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['Zona']['nombre']))?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>