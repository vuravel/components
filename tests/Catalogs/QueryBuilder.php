<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;
use Vuravel\Components\Tests\Models\Post;

class QueryBuilder extends Catalog
{
    public function query()
	{
		return \DB::table('posts')->where('id', '>=', 1); //to return all of them
	}
}