<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;
use Vuravel\Components\Tests\Models\Post;

class QueryEloquentModelProperty extends Catalog
{
	public static $model = Post::class;
}