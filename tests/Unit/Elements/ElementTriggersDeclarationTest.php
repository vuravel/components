<?php
namespace Vuravel\Components\Tests\Unit\Elements;

use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Elements\Exceptions\TriggerNotAllowedException;
use Vuravel\Elements\Exceptions\BadTriggerDefinitionException;
use Vuravel\Components\Tests\Forms\Elements\{BadTriggerForm, TriggerNotAllowedForm, TriggerIsAcceptableStringForm, TriggerIsAcceptableArrayForm, TriggerIsArrayButNotAccetableForm};

class ElementTriggersDeclarationTest extends EnvironmentBoot
{
	/** @test */
	public function triggers_is_not_a_string_or_array()
	{
		$this->expectException(BadTriggerDefinitionException::class);

		$form = new BadTriggerForm();
	}

	/** @test */
	public function trigger_is_not_allowed()
	{
		$this->expectException(TriggerNotAllowedException::class);

		$form = new TriggerNotAllowedForm();
	}

	/** @test */
	public function trigger_is_array_but_not_acceptable()
	{
		$this->expectException(TriggerNotAllowedException::class);

		$form = new TriggerIsArrayButNotAccetableForm();
	}

	/** @test */
	public function trigger_is_acceptable_string()
	{
		$form = new TriggerIsAcceptableStringForm();

		$this->assertCount(1, $form->components[0]->triggers);
		$this->assertCount(1, $form->components[0]->triggers['click']);
	}

	/** @test */
	public function trigger_is_acceptable_array()
	{
		$form = new TriggerIsAcceptableArrayForm();

		$this->assertCount(2, $form->components[0]->triggers);
		$this->assertCount(1, $form->components[0]->triggers['click']);
		$this->assertCount(1, $form->components[0]->triggers['change']);
	}

}