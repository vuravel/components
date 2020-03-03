<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, MultiFile, MultiImage, Html, MultiPlace, MultiForm, Button};
use Vuravel\Components\Tests\Forms\MultiForm as ChildForm;

class ObjHasMany extends Form
{
	public static $model = 'App\Models\Examples\Obj';

	public function components()
	{
		return [
			Input::form('Title'),
			Html::form('No Select with HasMany (impossible)'),
			MultiFile::form('Filehms'),
			MultiImage::form('Imagehms'),
			MultiPlace::form('Placehms'),
			//MultiForm::form(ChildForm::class),
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