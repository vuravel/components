<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;
use Vuravel\Components\Tests\Models\Post;

class QueryEloquentModel extends Catalog
{
    public function query()
	{
		return new Post();
	}
}