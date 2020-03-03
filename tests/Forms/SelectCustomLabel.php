<?php
namespace Vuravel\Components\Tests\Forms;

use Vuravel\Catalog\Cards\IconText;
use Vuravel\Form\Components\{Select, MultiSelect, Button};
use Vuravel\Form\Form;
use Vuravel\Components\Tests\Models\Obj;


class SelectCustomLabel extends Form
{
	public static $model = Obj::class;
	
	public function authorize()
	{
		return true;
	}
	

	public function components()
	{
		return [
			Select::form('tag')
				->options($this->options()),
			MultiSelect::form('tags')
				->options($this->options()),
			Button::form(__('Submit'))->submitsForm()
		];
	}

	public function options()
	{
		return [
			'1' => IconText::form(['icon' => 'icon-location', 'text' => 'Option 1']),
			'2' => IconText::form(['icon' => 'icon-location', 'text' => 'Option 2']),
			'3' => IconText::form(['icon' => 'icon-location', 'text' => 'Option 3']),
			'4' => IconText::form(['icon' => 'icon-location', 'text' => 'Option 4']),
			'5' => IconText::form(['icon' => 'icon-location', 'text' => 'Option 5']),
		];
	}

	public function rules()
	{
		return [
			'tag' => 'required|in:1,2,3,4,5',
			'tags' => 'min:1',
			'tags.*' => 'in:1,2,3,4,5',
    	];
	}
}