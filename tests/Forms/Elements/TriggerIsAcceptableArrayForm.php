<?php
namespace Vuravel\Components\Tests\Forms\Elements;

use Vuravel\Components\{Select, Form};

class TriggerIsAcceptableArrayForm extends Form
{
	public function components()
	{
		return [
			Select::form('Title')->on(['click', 'change'], function() {})
		];
	}
}