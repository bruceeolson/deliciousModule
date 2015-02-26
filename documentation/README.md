# Yii Delicious Module

## Installation

1. put the delicious directory under protected/modules


1. modify your config modules

    'modules'=>array(
		'delicious'=>array(
			'pageTitle' => 'My Delicious Tags', 
			'user' => 'olsonbruce18',  // delicious username
			'tags' => array(
							'nova_companies',
							'apache',
							'css',
							'dom',
							'facebook',
							'google',
							'html',
							'html5',
							'javascript','markdown','mobile','phantomjs','php','yii','jqm','jquery','jqueryplugins','github','unix','webtools'),
			'pageLayoutPath' => 'application.views.layouts',
			'layoutName' => 'column1',
		),
    ),


1. modify your config urlManager

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'delicious/refresh'=>'delicious/Default/refresh',
				'delicious/refresh/<tag:\w+>'=>'delicious/Default/refresh',
			),
		),
