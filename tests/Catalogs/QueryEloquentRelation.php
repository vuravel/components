<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;
use Vuravel\Components\Tests\Models\Tag;

class QueryEloquentRelation extends Catalog
{
    public function query()
	{
		return Tag::find(1)->posts(); //to return all of them
	}
}