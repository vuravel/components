<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;
use Vuravel\Components\Tests\Models\Obj;

class Imagemtm extends Model
{	
	public function objs() 
	{
		return $this->morphedByMany(Obj::class, 'model', 'obj_imagemtm'); 
	}

}
