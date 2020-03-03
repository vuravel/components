<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;

class SimplePostForm extends Form
{
	protected $submitTo = 'test-post-route';

	public function components()
	{
		return [
			// no need for components since they are not directly being tested
		];
	}

	public function rules()
	{
		return [
			'input' => 'max:10',
			'file' => 'file|max:100', //max 100KB
			'files.*' => 'file|max:100', //max 100KB
			'select' => 'in:valid',
			'multiselect' => 'array|min:1',
			'multiselect.*' => 'in:valid1,valid2,valid3',
		];
	}
	
	public function authorize()
	{
		return true;
	}
}