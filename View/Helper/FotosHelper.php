<?php

/* SYMDev */

/**
 * Description of FotosHelper
 *
 * @author Sinue Yanez
 */
class FotosHelper extends AppHelper{
    
    public $helpers = array(
        'Html'
    );
    
    public function thumb($archivo,$options = array()){
        if(empty($archivo)) return 'No Thumb';
        $default_options = array(
            'width' => '100%',
            'class' => 'thumbnail',
            'style' => 'border:0',
            'title' => 'thumb'
        );
        if(!empty($options)) $default_options = array_merge ($default_options,$options);
        $before = $after = '';
        if(isset($default_options['before'])){
            $before = $default_options['before'];                    
            unset($default_options['before']);
        }
        if(isset($default_options['after'])){
            $after = $default_options['after'];
            unset($default_options['after']);
        }
        return $before.$this->Html->image(BIENES_RAICES_FOLDER.'/'.$archivo,$default_options).$after;
    }
    
    public function uploadify($fileInputId,$target,$options = array()){        
        $timestamp = time();
        $default_options = array(
            'debug' => true,
            'buttonText' => 'Selecciona',
            'formData' => array(
                'timestamp' => $timestamp,
                'token' => md5('unique_salt' . $timestamp)
            ),
            'swf' => $this->webroot.'bienes_raices/libs/uploadify/uploadify.swf',
            'uploader' => $target            
        );
        $this->Html->css($this->webroot.'bienes_raices/libs/uploadify/uploadify', array('inline'=>false));
        $this->Html->script($this->webroot.'bienes_raices/libs/uploadify/jquery.uploadify.min', false);
        if(!empty($options))
            $default_options = array_merge ($default_options, $options);
        $this->Html->scriptStart();
        // Uploadify jquery script
        ?>
        if(typeof(Bienes_Raices) == 'undefined'){Bienes_Raices = {}}
        Bienes_Raices.Uploadify = {"onUploadSuccess":function(file, data, response){console.log(data);$("#uploadify-preview").prepend(data);}};
        Bienes_Raices.Uploadify.options = <?=json_encode($default_options)?>;
        Bienes_Raices.Uploadify.options.onUploadSuccess = Bienes_Raices.Uploadify.onUploadSuccess;
        $('#<?=$fileInputId?>').uploadify(Bienes_Raices.Uploadify.options);
        <?php
        echo $this->Html->scriptEnd();
        echo '<div id="uploadify-preview"></div>';
        
    }
}
