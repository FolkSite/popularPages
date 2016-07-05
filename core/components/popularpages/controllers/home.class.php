<?php

/**
 * The home manager controller for popularPages.
 *
 */
class popularPagesHomeManagerController extends popularPagesMainController {
	/* @var popularPages $popularPages */
	public $popularPages;
	
	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}

	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('popularpages');
	}

	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->popularPages->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->popularPages->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		
		$this->addJavascript($this->popularPages->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->popularPages->config['jsUrl'] . 'mgr/extras/popularpages.combo.js');
		$this->addJavascript($this->popularPages->config['jsUrl'] . 'mgr/widgets/popularpages.grid.js');
		$this->addJavascript($this->popularPages->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->popularPages->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "popularpages-page-home"});
		});
		</script>');
	}

	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->popularPages->config['templatesPath'] . 'home.tpl';
	}
}