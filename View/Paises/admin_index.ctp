<h3><?=__('Paises')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table class="table table-bordered table-stripped">
    <thead>
    <th>TNID</th>
    <th><?=__('Nombre')?></th>
    <th><?=__('Codigo')?></th>
    <th><?=__('Nomre ISO')?></th>
    <th><?=__('ISO 2')?></th>
    <th><?=__('ISO 3')?></th>    
    <th></th>
    </thead>
    <tbody>
        <?php if(!empty($data)): foreach($data as $row):?>
        <tr>
            <td><?=$row['Pais']['id']?></td>
            <td><?=$row['Pais']['nombre']?></td>
            <td><?=$row['Pais']['codigo']?></td>
            <td><?=$row['Pais']['isonombre']?></td>
            <td><?=$row['Pais']['iso2']?></td>
            <td><?=$row['Pais']['iso3']?></td>
            <td>
                <?=$this->Html->link(__('editar'),'editar/'.$row['Pais']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['Pais']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['Pais']['nombre']))?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>