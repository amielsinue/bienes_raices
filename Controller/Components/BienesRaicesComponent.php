<?php

/* SYMDev */

/**
 * Description of BienesRaicesComponent
 *
 * @author Sinue Yanez
 */
class BienesRaicesComponent extends Component{
    
    public function __construct(ComponentCollection $collection, $settings = array()) {
		$settings = array_merge($this->settings, (array)$settings);
		$this->Controller = $collection->getController();
		parent::__construct($collection, $settings);
	}
}
