<?php

return [

	'default_date_format' => 'Y-m-d',
	'default_time_format' => 'H:i',
	'default_datetime_format' => 'Y-m-d H:i',

	'files_attributes' => [
		'name' => 'name',
		'path' => 'path',
		'mime_type' => 'mime_type',
		'size' => 'size',
		'id' => 'id' //not used when files are relationships => the model's primary key is used
	],

    'locales' => [
        //'en' => 'English',
        //'fr' => 'Français'
    ],

    'smart_readonly_fields' => false,

    'files' => [
    	'isMonogamous' => true //to review
    ]
];
