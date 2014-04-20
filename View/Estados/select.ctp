<option value="">Selecciona</option>
<?php if(!empty($data)):foreach($data as $id=>$nombre):?>
<option value="<?=$id?>" <?=($estados_id==$id)?'selected':''?>><?=$nombre?></option>
<?php endforeach;endif;?>
