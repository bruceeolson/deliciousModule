<?php

class DefaultController extends CController
{		
	private $_feed = 'http://feeds.delicious.com/v2/json';
	private $_tags;
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules() {
		return array( array('allow',  'users'=>array('*') ));
	}
	
	public function actionIndex($tag=NULL) {
				
		$this->layout = $this->module->layout;
		$links = FALSE;
		ksort($this->_tags);
		
		if ( isset($tag) ) $links = json_decode($this->delicious($this->url($tag)));
		$this->render($this->module->view, array('tags'=>$this->_tags, 'links'=>$links, 'tag'=>$tag));				
	}
		
	private function url($tag) { return $this->_feed.'/'.$this->module->user.'/'.$tag.'?count=100'; }
	
	protected function beforeAction($action) {
		
		$showAll = isset($_GET['show']) ? TRUE : FALSE;
		
		$this->_tags = json_decode($this->delicious($this->_feed.'/tags/'.$this->module->user),TRUE);
		//$this->_tags = json_decode('{"jQuery": 9, "markdown": 6, "adobe": 4, "nosql": 1, "DOM": 2, "Travel": 2, "iTechniques": 17, "mai": 5, "unix": 7, "jqueryPlugins": 14, "Wordpress": 9, "CompliancePartners": 9, "macTips": 12, "webTools": 16, "ie": 1, "Security": 1, "nova_companies": 14, "Brugarts": 6, "java": 1, "phantomjs": 1, "Bruce": 7, "mamp": 1, "openicebox": 4, "nodejs": 1, "yii": 29, "webTechniques": 20, "python": 1, "html": 5, "grodo": 9, "508": 1, "Real_estate": 1, "main": 4, "XML/XSLT": 17, "css": 28, "School": 2, "jqm": 9, "shelter": 1, "manuals": 3, "javascript": 25, "facebook": 4, "html5": 14, "sql": 5, "apache": 6, "google": 4, "php": 10, "DeveloperTools": 5, "github": 7, "mobile": 22, "Emmanuel": 4, "arcgis": 2, "eviction": 3, "Design": 1, "cool_website_layouts": 1, "iPhone": 1}',TRUE);
				
		if ( Yii::app()->user->isGuest && !$showAll ) {
			foreach ( $this->module->tagsPrivate as $tag ) {
				if ( array_key_exists($tag, $this->_tags) ) unset($this->_tags[$tag]);
			}
		}
		return TRUE;
	}
	
	private function delicious($request) {
		$ch = curl_init($request);		
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		$payload = curl_exec($ch);
		curl_close($ch);
		return $payload;
	}

}
