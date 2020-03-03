<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Components\{Input, MultiFile, MultiImage, MultiSelect, MultiPlace, MultiForm, Button};
use Vuravel\Form\Form;
use Vuravel\Components\Tests\Models\Obj;

class ObjBelongsToMany extends Form
{
	public static $model = Obj::class;

	public function components()
	{
		return [
			Input::form('Title'),
			MultiSelect::form('Tagbtms')->optionsFrom('id','title'),
			MultiFile::form('Filebtms'),
			MultiImage::form('Imagebtms'),
			MultiPlace::form('Placebtms'),
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