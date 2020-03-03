<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Fileho extends Model
{
	public $fillable = ['name', 'path', 'mime_type', 'size'];

	public function obj() 
	{
		return $this->belongsTo('Vuravel\Components\Tests\Models\Obj'); 
	}

}
