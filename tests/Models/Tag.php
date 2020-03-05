<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;
use Vuravel\Components\Tests\Models\Post;

class Tag extends Model
{	
	
	public function posts() 
	{
		return $this->belongsToMany(Post::class); 
	}

}
