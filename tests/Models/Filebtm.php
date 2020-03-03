<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Filebtm extends Model
{
	public $fillable = ['name', 'path', 'mime_type', 'size'];
	
	public function objs() 
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Obj'); 
	}

}
