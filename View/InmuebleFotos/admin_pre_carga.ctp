<?php 
$this->Form->create();
$uid = uniqid(time());
?>
<div class="success">
    <label><?=$nombre?> cargado correctamente</label>
    <input type="hidden" name="data[InmuebleFoto][<?=$uid?>][archivo]" value="<?=$archivo?>" />
    <input type="hidden" name="data[InmuebleFoto][<?=$uid?>][nombre]" value="<?=$nombre?>" />
</div>
<?php $this->Form->end()?>