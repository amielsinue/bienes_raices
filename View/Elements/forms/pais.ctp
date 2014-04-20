<?=$this->Form->create()?>
<table>
    <tr>
        <td><?=__('Nombre')?></td>
        <td>
        <?=$this->Form->input('nombre',array('label' => false))?>
        <em><?=$this->Html->link('referencias','http://es.wikipedia.org/wiki/ISO_3166-1#C.C3.B3digos_ISO_3166-1',array('target'=>'_blank'))?></em>
        </td>
    </tr>
    <tr>
        <td><?=__('Codigo')?></td>
        <td><?=$this->Form->input('codigo',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('Nombre ISO')?></td>
        <td><?=$this->Form->input('isonombre',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('ISO2')?></td>
        <td><?=$this->Form->input('iso2',array('label' => false))?></td>
    </tr>
    <tr>
        <td><?=__('ISO3')?></td>
        <td><?=$this->Form->input('iso3',array('label' => false))?></td>
    </tr>    
</table>
<?=$this->Form->end(__('Guardar'))?>
