<?php
namespace Vuravel\Components\Tests\Forms\Elements;

use Vuravel\Components\{Input, Form};

class TriggerIsArrayButNotAccetableForm extends Form
{
	public function components()
	{
		return [
			Input::form('Title')->on(['click', 'headbang'], function() {})
		];
	}
}