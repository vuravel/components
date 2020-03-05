<?php
namespace Vuravel\Components\Tests\Forms\Elements;

use Vuravel\Components\{Input, Form};

class TriggerNotAllowedForm extends Form
{
	public function components()
	{
		return [
			Input::form('Title')->on('headbang', function() {})
		];
	}
}