<?php
namespace Vuravel\Components\Tests\Forms;

use Vuravel\Catalog\Cards\IconText;
use Vuravel\Form\Components\{Select, Button};
use Vuravel\Form\Form;
use Vuravel\Components\Tests\Models\Childobj;

class SelectOptionsFrom extends Form
{
	public static $model = Childobj::class;
	
	public function authorize()
	{
		return true;
	}

	public function components()
	{
		return [
			Select::form('obj')->optionsFrom('id', IconText::form([
				'text' => function($obj){ 
					return strtoupper($obj->title); 
				},
				'icon' => function($obj){ 
					return 'icon-location'; 
				}
			])),
			Button::form(__('Submit'))->submitsForm()
		];
	}

	public function rules()
	{
		return [
			'obj' => 'required|exists:objs,id'
    	];
	}
}