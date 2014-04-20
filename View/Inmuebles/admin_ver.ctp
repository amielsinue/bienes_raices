<h3>Imueble [<?=$data['Inmueble']['codigo']?>]</h3>
<?=$this->Html->link(__('Lista'),'index')?>
<table>
    <tr>
        <td><?=__('Pais')?></td>
        <td><?=$data['Inmueble']['paises_nombre']?></td>
    </tr>
    <tr>
        <td><?=__('Estado')?></td>
        <td><?=$data['Inmueble']['estados_nombre']?></td>
    </tr>
    <tr>
        <td><?=__('Ciudad')?></td>
        <td><?=$data['Inmueble']['ciudades_nombre']?></td>
    </tr>
    <tr>
        <td><?=__('Zonas')?></td>
        <td><?=$data['Zona']['nombre']?></td>
    </tr>
    <tr>
        <td><?=__('Tipo de Inmueble')?></td>
        <td><?=$data['TipoInmueble']['nombre']?></td>
    </tr>
    <tr>
        <td><?=__('Tipo de Negocio')?></td>
        <td><?=$data['TipoNegocio']['nombre']?></td>
    </tr>
    <tr>
        <td><?=__('Codigo')?></td>
        <td><?=$data['Inmueble']['codigo']?></td>
    </tr>
    <tr>
        <td><?=__('Area construida')?></td>
        <td><?=$data['Inmueble']['area_construida']?></td>
    </tr>
    <tr>
        <td><?=__('Area Terreno')?></td>
        <td><?=$data['Inmueble']['area_terreno']?></td>
    </tr>
    <tr>
        <td><?=__('Habitaciones')?></td>
        <td><?=$data['Inmueble']['habitaciones']?></td>
    </tr>
    <tr>
        <td><?=__('Banos')?></td>
        <td><?=$data['Inmueble']['banos']?></td>
    </tr>
    <tr>
        <td><?=__('Garaje')?></td>
        <td><?=$data['Inmueble']['garaje']?></td>
    </tr>
    <tr>
        <td><?=__('Precio')?></td>
        <td><?=$this->Number->currency($data['Inmueble']['precio'])?></td>
    </tr>
    <tr>
        <td><?=__('Otras Caracteristicas')?></td>
        <td><?=$data['Inmueble']['caracteristicas']?></td>
    </tr>
    <tr>
        <td><?=__('Descripcion')?></td>
        <td><?=$data['Inmueble']['descripcion']?></td>
    </tr>
    <tr>
        <td><?=__('Mapa')?></td>
        <td>            
            <div id="InmuebleMapaContenedor" style="width: 800px; height: 800px;"></div>
            <?php 
            $this->Mapa->coordenadas = $data['Inmueble']['coordenadas'];
            $this->Mapa->init('InmuebleCoordenadas','InmuebleMapaContenedor',true);
            ?>
        </td>
    </tr>
    <tr>
        <td><?=__('Fotos')?></td>
        <td>
            <?php if(isset($data['InmuebleFoto'])):foreach($data['InmuebleFoto'] as $foto):?>
                <div style="float:left;margin:3px;">
                    <?=$this->Fotos->thumb($foto['archivo'],array(
                        'width'=>'200px',             
                        'alt' => $foto['nombre'],
                        'title' => $foto['nombre']                        
                    ))?>                
                </div>
            <?php endforeach;endif;?>
        </td>
    </tr>
</table>