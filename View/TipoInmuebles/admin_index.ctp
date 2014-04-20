<h3><?=__('Tipo de inmuebles')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table class="table table-bordered table-stripped">
    <thead>
    <th>TIID</th>
    <th><?=__('Nombre')?></th>
    <th><?=__('Descripcion')?></th>
    <th></th>
    </thead>
    <tbody>
        <?php if(!empty($data)): foreach($data as $row):?>
        <tr>
            <td><?=$row['TipoInmueble']['id']?></td>
            <td><?=$row['TipoInmueble']['nombre']?></td>
            <td><?=$row['TipoInmueble']['descripcion']?></td>
            <td>
                <?=$this->Html->link(__('editar'),'editar/'.$row['TipoInmueble']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['TipoInmueble']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['TipoInmueble']['nombre']))?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>