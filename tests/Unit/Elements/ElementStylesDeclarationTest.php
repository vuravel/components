<?php
namespace Vuravel\Components\Tests\Unit\Elements;

use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\Elements\SetElementStylesForm;

class ElementStylesDeclarationTest extends EnvironmentBoot
{
	/** @test */
	public function styles_are_set_on_element()
	{
		$form = new SetElementStylesForm();

		$this->assertEquals('margin:0', $form->components[0]->style);
		$this->assertEquals('margin:0', $form->components[1]->style);
		$this->assertEquals('margin:0', $form->components[2]->style);
		$this->assertEquals('margin:0;padding:0', $form->components[3]->style);
		$this->assertEquals('margin:0;padding:0;color:red', $form->components[4]->style);
	}

}