<?php
namespace Vuravel\Components\Tests\Forms\Elements;

use Vuravel\Components\{Input, Form};

class BadTriggerForm extends Form
{
	public function components()
	{
		return [
			Input::form('Title')->on(1, function() {})
		];
	}
}