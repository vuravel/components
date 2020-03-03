<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Components\{Input, MultiFile, MultiImage, MultiSelect, MultiPlace, MultiForm, Button};
use Vuravel\Form\Form;
use Vuravel\Components\Tests\Models\Obj;

class ObjMorphToMany extends Form
{
	public static $model = Obj::class;

	public function components()
	{
		return [
			Input::form('Title'),
			MultiSelect::form('Tagmtms')->optionsFrom('id','title'),
			MultiFile::form('Filemtms'),
			MultiImage::form('Imagemtms'),
			MultiPlace::form('Placemtms'),
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