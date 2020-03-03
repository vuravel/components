<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, File, Image, Html, Place, Button};
use Vuravel\Components\Tests\Models\Obj;

class ObjMorphOne extends Form
{
	public static $model = Obj::class;

	public function components()
	{
		return [
			Input::form('Title'),
			Html::form('No Select with MorphOne (impossible)'),
			File::form('Filemo'),
			Image::form('Imagemo'),
			Place::form('Placemo'),
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