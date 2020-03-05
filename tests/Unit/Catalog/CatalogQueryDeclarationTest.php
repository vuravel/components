<?php
namespace Vuravel\Components\Tests\Unit\Catalog;

use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Models\{Post, Tag};
use Vuravel\Components\Tests\Catalogs\{QueryEloquentModel, QueryEloquentModelProperty, QueryEloquentBuilder, QueryEloquentRelation, QueryBuilder, QueryCollection, QueryArray, QueryNull};

class CatalogQueryDeclarationTest extends EnvironmentBoot
{
	/** @test */
	public function query_returns_an_eloquent_model()
	{
		factory(Post::class, 10)->create();
		$catalog = new QueryEloquentModel();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}

	/** @test */
	public function query_use_model_property()
	{
		factory(Post::class, 10)->create();
		$catalog = new QueryEloquentModelProperty();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}

	/** @test */
	public function query_returns_an_eloquent_builder()
	{
		factory(Post::class, 10)->create();
		$catalog = new QueryEloquentBuilder();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}

	/** @test */
	public function query_returns_an_eloquent_relation()
	{
		factory(Post::class, 10)->create();
		factory(Tag::class, 1)->create();
		Post::get()->each(function($post){
			$post->tags()->attach(1);
		});
		$catalog = new QueryEloquentRelation();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}


	/** @test */
	public function query_returns_a_query_builder()
	{
		factory(Post::class, 10)->create();
		$catalog = new QueryBuilder();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}


	/** @test */
	public function query_returns_a_collection()
	{
		$catalog = new QueryCollection();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}


	/** @test */
	public function query_returns_an_array()
	{
		$catalog = new QueryArray();

		$this->assertCount(10, $catalog->paginator->pagination->getCollection());
	}

	/** @test */
	public function query_returns_null()
	{
		$catalog = new QueryNull();

		$this->assertCount(0, $catalog->paginator->pagination->getCollection());
	}


}