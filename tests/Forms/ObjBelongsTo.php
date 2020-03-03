<?php
namespace Vuravel\Components\Tests\Forms;
use Vuravel\Form\Form;
use Vuravel\Form\Components\{Input, File, Image, Select, Place, Html, Button};
use App\Models\Examples\Childobj;

class ObjBelongsTo extends Form
{
	public static $model = Childobj::class;

	public function components()
	{
		return [
			Input::form('Title'),
			Select::form('Obj')->optionsFrom('id','title'),
			Html::form('No File with BelongsTo (impossible)'),
			Html::form('No Image with BelongsTo (impossible)'),
			Html::form('No Place with BelongsTo (impossible)'),

			/*File::form('File'),
			Image::form('Image'),   HMMMMMMMMM WHAT TO DO?
			Place::form('Place'),*/ 
			Button::form('Save')->submitsForm()
		];
	}
	
	public function authorize()
	{
		return true; //For tests to pass
	}
}