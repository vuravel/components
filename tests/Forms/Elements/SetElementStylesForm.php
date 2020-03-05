<?php
namespace Vuravel\Components\Tests\Forms\Elements;

use Vuravel\Components\{Input, Form};

class SetElementStylesForm extends Form
{
	public function components()
	{
		return [
			Input::form('Title')->style('margin:0'),
			Input::form('Title')->style('anything')->style('margin:0'),
			Input::form('Title')->addStyle('margin:0'),
			Input::form('Title')->style('margin:0')->addStyle('padding:0'),
			Input::form('Title')->style('margin:0')->addStyle('padding:0;color:red')
		];
	}
}