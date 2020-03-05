<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;

class QueryCollection extends Catalog
{
    public function query()
	{
		return collect([1,2,3,4,5,6,7,8,9,10]);
	}
}