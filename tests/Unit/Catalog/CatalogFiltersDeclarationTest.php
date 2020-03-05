<?php
namespace Vuravel\Components\Tests\Unit\Catalog;

use Vuravel\Components\Tests\Catalogs\FiltersReturnTypes;
use Vuravel\Components\Tests\EnvironmentBoot;
use Illuminate\Support\Collection;

class CatalogFiltersDeclarationTest extends EnvironmentBoot
{
    public $filtersPlacement = [ 'top', 'left', 'bottom', 'right' ];

	/** @test */
	public function filters_are_array_and_subfilters_collections()
	{
		$catalog = new FiltersReturnTypes();

		$this->assertIsArray($catalog->filters);

		foreach ($this->filtersPlacement as $placement) {
			$this->assertArrayHasKey($placement, $catalog->filters);
			$this->assertInstanceOf(Collection::class, $catalog->filters[$placement]);
		}
	}

	/** @test */
	public function null_components_are_removed_in_filters()
	{
		$catalog = new FiltersReturnTypes();

		$this->assertCount(1, $catalog->filters['top']);
		$this->assertCount(1, $catalog->filters['right']);
		$this->assertCount(1, $catalog->filters['bottom']);
		$this->assertCount(0, $catalog->filters['left']);

	}

}