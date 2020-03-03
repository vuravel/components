<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, File, Image, Select, Place, Button};
use Vuravel\Components\Tests\Models\Obj;

class ObjFillOne extends Form
{
	public static $model = Obj::class;

	public function components()
	{
		return [
			Input::form('Title'),
			Select::form('Tag')->options([
				'1' => 'First',
				'2' => 'Second',
				'3' => 'Third',
				'4' => 'Fourth',
				'5' => 'Fifth',
				'6' => 'Sixth'
			]),
			File::form('File'),
			Image::form('Image'),
			Place::form('Place'),
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