<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;
use Vuravel\Components\Tests\Models\Obj;

class Tagbtm extends Model
{	
	public function objs() 
	{
		return $this->belongsToMany(Obj::class); 
	}

}
