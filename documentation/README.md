# Yii Delicious Module

## Installation

1. put the delicious directory under protected/modules


1. add the delicious module to config modules

    'modules'=>array(
		'delicious'=>array(
			'pageTitle' => 'My Delicious Tags', 
			'user' => 'olsonbruce18',  // delicious username
			'tagsPrivate' => array('Bruce','Brugarts','Susan','email','Emmanuel','Ephesians','mai','ncmec','nova_companies','Real_estate','Save','shelter','Travel','Recipes'),
			'layout' => 'application.views.layouts.column1',
			'view' => 'application.modules.delicious.views.default.index',
		),
    ),


1. add delicious RESTful path to your config urlManager

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'delicious/<tag:\w*>'=>'delicious/Default/index',
			),
		),
