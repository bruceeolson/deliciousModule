<?php

class DeliciousModule extends CWebModule {
	
	public $pageTitle;
	public $user;
	public $tags;
	public $pageLayoutPath;
	public $layoutName;
	
    public function init() {
		$this->layoutPath = Yii::getPathOfAlias($this->pageLayoutPath);
    }
    
}