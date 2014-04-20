<h3><?=__('Inmuebles')?></h3>
<?=$this->Html->link(__('Agregar'),'nuevo')?>
<table>
    <thead>
    <th>INID</th>
    <th><?=__('Foto')?></th>
    <th><?=__('Codigo')?></th>
    <th><?=__('Zona')?></th>
    <th><?=__('Ciudad')?></th>
    <th><?=__('Estado')?></th>
    <th><?=__('Pais')?></th>    
    <th></th>    
    </thead>
    <tbody>
    <?php if(!empty($data)):foreach($data as $row):
        $zona_info = $zonas[$row['Zona']['id']];
        ?>
        <tr>
            <td><?=$row['Inmueble']['id']?></td>
            <td><?=$this->BienesRaices->thumb($row['InmuebleFoto'],array('width'=>'50px'))?></td>
            <td><?=$row['Inmueble']['codigo']?></td>
            <td><?=$row['Zona']['nombre']?></td>
            <td><?=$zona_info['ciudad']?></td>
            <td><?=$zona_info['estado']?></td>
            <td><?=$zona_info['pais']?></td>            
            <td>
                <?=$this->Html->link(__('Ver'),'ver/'.$row['Inmueble']['id'])?>
                <?=$this->Html->link(__('editar'),'editar/'.$row['Inmueble']['id'])?>
                <?=$this->Form->postLink(__('borrar'),'eliminar',array(
                    'data' => array('id' => $row['Inmueble']['id'])
                ),
                        __('Realmente deseas elminar este registro: %s',$row['Inmueble']['codigo']))?>
            </td>
        </tr>        
    <?php endforeach;endif;?>
    </tbody>
</table>
<ul>
    <li><?=$this->Html->link(__('Zonas'),array('controller'=>'zonas','action'=>'index'))?></li>    
    <li><?=$this->Html->link(__('Ciudades'),array('controller'=>'ciudades','action'=>'index'))?></li>
    <li><?=$this->Html->link(__('Estados'),array('controller'=>'estados','action'=>'index'))?></li>
    <li><?=$this->Html->link(__('Paises'),array('controller'=>'paises','action'=>'index'))?></li>
</ul>