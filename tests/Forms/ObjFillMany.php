<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, MultiFile, MultiImage, MultiSelect, MultiPlace, MultiForm, Button};

class ObjFillMany extends Form
{
	public static $model = 'App\Models\Examples\Obj';

	public function components()
	{
		return [
			Input::form('Title'),
			MultiSelect::form('Tags')->options([
				'1' => 'First',
				'2' => 'Second',
				'3' => 'Third',
				'4' => 'Fourth',
				'5' => 'Fifth',
				'6' => 'Sixth'
			]),
			MultiFile::form('File'),
			MultiImage::form('Image'),
			MultiPlace::form('Place'),
			Button::form('Save')->submitsForm()
		];
	}
	
	public function authorize()
	{
		return true;
	}
}