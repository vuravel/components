<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;
use Vuravel\Components\Tests\Models\Tag;

class Post extends Model
{	
	
	public function tags() 
	{
		return $this->belongsToMany(Tag::class); 
	}

}
