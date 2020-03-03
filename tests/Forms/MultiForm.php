<?php

namespace Vuravel\Components\Tests\Forms;

use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, Textarea};

class MultiForm extends Form
{
	public function components()
	{
		return [
			Input::form('Title'),
			Textarea::form('Body')
		];
	}

	public function rules()
	{
		return [
			'title' => 'required',
      		'body' => 'min:10'
    	];
	}
}