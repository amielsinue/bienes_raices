<h2><?=__('Editar Tipo de Inmuebles')?> [<?=$this->data['TipoInmueble']['nombre']?>]</h2>
<?=$this->Html->link(__('Lista'),'index')?>
<?=$this->element('forms/tipo_de_inmueble')?>