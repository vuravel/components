<?php
namespace Vuravel\Components\Tests\Unit\Elements;

use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\Elements\SetElementClassForm;

class ElementClassDeclarationTest extends EnvironmentBoot
{
	/** @test */
	public function class_is_set_on_element()
	{
		$form = new SetElementClassForm();

		$this->assertEquals('class-0', $form->components[0]->class);
		$this->assertEquals('class-1', $form->components[1]->class);
		$this->assertEquals('class-2', $form->components[2]->class);
		$this->assertEquals('class-3a class-3b', $form->components[3]->class);
		$this->assertEquals('class-4a class-4b class-4c', $form->components[4]->class);
	}

}