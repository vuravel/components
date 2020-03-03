<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Filemm extends Model
{
	public $fillable = ['name', 'path', 'mime_type', 'size'];
	
	public function obj() 
	{
		return $this->morphTo(); 
	}

}
