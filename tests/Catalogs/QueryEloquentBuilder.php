<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;
use Vuravel\Components\Tests\Models\Post;

class QueryEloquentBuilder extends Catalog
{
    public function query()
	{
		return Post::where('id', '>=', 1); //to return all of them
	}
}