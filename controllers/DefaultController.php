<?php

class DefaultController extends CController
{
		
	private $_feed = 'http://feeds.delicious.com/v2/json';
	
	const DS = DIRECTORY_SEPARATOR;

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules() {
		return array( array('allow',  'users'=>array('*') ));
	}
	
	public function actionIndex() {
		
		$this->layout = $this->module->layoutName;
		$list = array();
		
		asort($this->module->tags);
		foreach ( $this->module->tags as $tag ) {
			$filename = $this->filePath($tag);
			if ( is_file($filename) ) $list[$tag] = json_decode(file_get_contents($filename));
			else $list[$tag] = new stdClass();
		}
		$this->render('index', array('list'=>$list));					
	}
	
	public function actionRefresh($tag="all") {
		$tag = strtolower($tag);
		if ( $tag == "all" ) foreach ( $this->module->tags as $tag ) $this->reload($tag);
		else $this->reload($tag);
		$this->actionIndex();					
	}
	
	private function reload($tag) {
		if ( !in_array($tag, $this->module->tags) ) return;
		$links = new MyCurl($this->url($tag));
		file_put_contents($this->filePath($tag),$links->payload);				
	}
	
	private function url($tag) { return $this->_feed.'/'.$this->module->user.'/'.$tag.'?count=100'; }
	
	private function filePath($tag) { return $this->module->basePath.self::DS.'data'.self::DS.$tag.'.json'; }

}
