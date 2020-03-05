<?php

namespace Vuravel\Components\Tests\Catalogs;

use Vuravel\Components\{Catalog, Columns};

class FiltersReturnTypes extends Catalog
{
	//Array
    public function top()
	{
		return [
			Columns::form(),
			null
		];
	}

	//Collection
    public function right()
	{
		return collect([
			Columns::form(),
			null
		]);
	}

	//One component
    public function bottom()
	{
		return Columns::form();
	}

	//null
	public function left()
	{
		return null;
	}
}