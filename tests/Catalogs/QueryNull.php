<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\Catalog;

class QueryNull extends Catalog
{
    public function query()
	{
		return null;
	}
}