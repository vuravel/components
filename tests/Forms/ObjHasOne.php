<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, File, Image, Html, Place, Button};
use Vuravel\Components\Tests\Models\Obj;

class ObjHasOne extends Form
{
	public static $model = Obj::class;

	public function components()
	{
		return [
			Input::form('Title'),
			Html::form('No Select with HasOne (impossible)'),
			File::form('Fileho'),
			Image::form('Imageho'),
			Place::form('Placeho'),
			Button::form('Save')->submitsForm()
		];
	}

	public function rules()
	{
		return [];
	}
	
	public function authorize()
	{
		return true;
	}
}