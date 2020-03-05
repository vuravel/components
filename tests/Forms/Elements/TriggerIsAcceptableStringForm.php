<?php
namespace Vuravel\Components\Tests\Forms\Elements;

use Vuravel\Components\{Button, Form};

class TriggerIsAcceptableStringForm extends Form
{
	public function components()
	{
		return [
			Button::form('Save')->on('click', function() {})
		];
	}
}