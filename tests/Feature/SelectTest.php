<?php
namespace Vuravel\Components\Tests\Feature;

use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjBelongsTo;
use Vuravel\Components\Tests\Forms\ObjBelongsToMany;
use Vuravel\Components\Tests\Forms\ObjMorphToMany;
use Vuravel\Components\Tests\Forms\{ObjFillMany, ObjFillOne, SelectAjaxOptions, SelectCustomLabel, SelectOptionsFrom};
use Vuravel\Components\Tests\Models\Obj;
use Vuravel\Components\Tests\Models\Tagbtm;
use Vuravel\Components\Tests\Models\Tagmtm;

class SelectTest extends EnvironmentBoot
{
	/** @test */
	public function receive_valid_select_from_request()
	{
		$testInput = 'valid';

		$this->simplePost([ 'select' => $testInput ])
			 ->assertStatus(200)
			 ->assertJson([ 'select' => $testInput ]);
	}

	/** @test */
	public function receive_invalid_select_response()
	{
		$testInput = 'invalid';

		$this->simplePost([ 'select' => $testInput ])
			 ->assertStatus(422)
			 ->assertJson([ 'errors' => ['select' => []] ]);
	}

	/** @test */
	public function receive_valid_select_multiple_from_request()
	{
		$testInput = ['valid1', 'valid2'];

		$this->simplePost([ 'multiselect' => $testInput	 ])
		 ->assertStatus(200)
		 ->assertJson([ 'multiselect' => $testInput ]);
	}

	/** @test */
	public function receive_invalid_select_multiple_response()
	{
		$testInput = ['valid1','invalid'];

		$this->simplePost([ 'multiselect' => $testInput ])
		 ->assertStatus(422)
		 ->assertJson([ 'errors' => ['multiselect.1' => []] ]);
	}

	/** @test */
	public function receive_invalid_select_multiple_empty_response()
	{
		$testInput = [];

		$this->simplePost([ 'multiselect' => $testInput ])
		 ->assertStatus(422)
		 ->assertJson([ 'errors' => ['multiselect' => []] ]);
	}

	/** @test */
	public function create_object_with_simple_select()
	{
		$this->create_object_with_select('test-input');
	}

	/** @test */
	public function update_object_with_simple_select()
	{
		$this->assertDatabaseMissing('objs', ['id' => 1 ]);
		$this->update_object_with_select('old-input', 'new-input');
	}

	/** @test */
	public function update_object_with_empty_select()
	{
		$this->assertDatabaseMissing('objs', ['id' => 1 ]);
		$this->update_object_with_select('old-input', null);
	}

	/** @test */
	public function create_object_with_multiple_select()
	{
		$this->create_object_with_multiselect(['1','2']);
	}

	/** @test */
	public function update_object_with_multiple_select()
	{
		$this->assertDatabaseMissing('objs', ['id' => 1 ]);
		$this->update_object_with_multiselect(['1','2'], ['2','3']);
	}

	/** @test */
	public function update_object_with_empty_multiple_select()
	{
		$this->assertDatabaseMissing('objs', ['id' => 1 ]);
		$this->update_object_with_multiselect(['1','2'], null);
	}
	
	/** @test */
	public function search_options_by_ajax_found()
	{
		$form = new SelectAjaxOptions();

        $this->withHeaders([ 'X-Vuravel-Id' => $form->id ])
        	->json('POST', route('vuravel-form.select-ajax-options'), [
	        	'method' => 'searchTags',
	        	'search' => 'Option 1'
	        ])
	        ->assertStatus(200)
	        ->assertJsonCount(1)
			->assertJson([ 0 => ['label' => 'Option 1'] ]);
	}
	
	/** @test */
	public function search_options_by_ajax_no_options()
	{
		$form = new SelectAjaxOptions();

        $this->withHeaders([ 'X-Vuravel-Id' => $form->id ])
        	->json('POST', route('vuravel-form.select-ajax-options'), [
	        	'method' => 'searchTags',
	        	'search' => 'WHATEVER'
	        ])->assertStatus(200)
		 	->assertJsonCount(0);
	}
	
	/** @test */
	public function load_options_from_value_in_ajax_options_select()
	{
		$this->assertDatabaseMissing('objs', ['id' => 1 ]);
		$this->eloquentPost(new SelectAjaxOptions(), ['tag' => 1])
			 ->assertStatus(200)
			 ->assertJson(['tag' => 1]);

    	$this->assertDatabaseHas('objs', ['tag' => 1 ]);

    	$form = SelectAjaxOptions::find(1);
    	$selectOptions = $form->components[0]->options;
    	$this->assertCount(1, $selectOptions);
    	$this->assertEquals(1, $selectOptions[0]['value']);
    	$this->assertEquals('Option 1', $selectOptions[0]['label']);
	}
	
	/** @test */
	public function load_multiple_options_from_value_in_ajax_options_select()
	{
		$this->assertDatabaseMissing('objs', ['id' => 1 ]);

		$this->eloquentPost(new SelectAjaxOptions(), ['tags' => [1,4] ])
			 ->assertStatus(200)
			 ->assertJson(['tags' => [1,4] ]);

    	$this->assertDatabaseHas('objs', ['tags' => json_encode([1,4]) ]);

    	$form = SelectAjaxOptions::find(1);
    	$selectMultipleOptions = $form->components[1]->options;

    	$this->assertCount(2, $selectMultipleOptions);
    	$this->assertEquals(1, $selectMultipleOptions[0]['value']);
    	$this->assertEquals('Option 1', $selectMultipleOptions[0]['label']);
    	$this->assertEquals(4, $selectMultipleOptions[1]['value']);
    	$this->assertEquals('Option 4', $selectMultipleOptions[1]['label']);
	}

	/** @test */
	public function options_are_transformed_in_custom_label_select()
	{
		$form = new SelectCustomLabel();
    	$selectMultipleOptions = $form->components[1]->options;

    	$this->assertCount(5, $selectMultipleOptions);
    	$this->assertEquals(1, $selectMultipleOptions[0]['value']);
    	$this->assertEquals('Option 1', $selectMultipleOptions[0]['label']->components['text']);
    	$this->assertEquals(4, $selectMultipleOptions[3]['value']);
    	$this->assertEquals('Option 4', $selectMultipleOptions[3]['label']->components['text']);
	}

	/** @test */
	public function options_are_loaded_from_relationship_with_optionsFrom()
	{
		$obj = new Obj();
		$obj->title = 'test title';
		$obj->save();
		$form = new SelectOptionsFrom();
    	$selectOptions = $form->components[0]->options;

    	$this->assertCount(1, $selectOptions);
    	$this->assertEquals(1, $selectOptions[0]['value']);
    	$this->assertEquals('TEST TITLE', $selectOptions[0]['label']->components['text']);
	}

	/** @test */
	public function test_create_object_with_select_belongsTo()
	{
		$this->create_object_with_select_belongsTo();
	}

	/** @test */
	public function test_update_object_with_select_belongsTo()
	{
		$this->update_object_with_select_belongsTo();
	}

	/** @test */
	public function test_create_object_with_select_belongsToMany()
	{
		$this->create_object_with_select_belongsToMany();
	}

	/** @test */
	public function test_update_object_with_select_belongsToMany()
	{
		$this->update_object_with_select_belongsToMany();
	}

	/** @test */
	public function test_update_object_with_empty_select_belongsToMany()
	{
		$this->create_object_with_select_belongsToMany();
		$this->eloquentPost(ObjBelongsToMany::find(1), ['tagbtms' => null])
			 ->assertStatus(200)
			 ->assertJson(['tagbtms' => null]);

    	$this->assertDatabaseHas('objs', ['id' => 1 ]);
    	$tagbtms = Obj::find(1)->tagbtms;

    	$this->assertCount(0, $tagbtms);
    	$this->assertDatabaseMissing('obj_tagbtm', ['tagbtm_id' => 1 ]);
	}

	/** @test */
	public function test_create_object_with_select_morphToMany()
	{
		$this->create_object_with_select_morphToMany();
	}

	/** @test */
	public function test_update_object_with_select_morphToMany()
	{
		$this->update_object_with_select_morphToMany();
	}

	/** @test */
	public function test_update_object_with_empty_select_morphToMany()
	{
		$this->create_object_with_select_morphToMany();
		$this->eloquentPost(ObjMorphToMany::find(1), ['tagmtms' => null])
			 ->assertStatus(200)
			 ->assertJson(['tagmtms' => null]);

    	$this->assertDatabaseHas('objs', ['id' => 1 ]);
    	$tagmtms = Obj::find(1)->tagmtms;

    	$this->assertCount(0, $tagmtms);
    	$this->assertDatabaseMissing('obj_tagmtm', ['tagmtm_id' => 1 ]);
	}
	
	
	/**********************************************
	*********   Refactored Assertions *************
	***********************************************/

	public function create_object_with_select($testInput)
	{
		$this->eloquentPost(new ObjFillOne(), ['tag' => $testInput])
			 ->assertStatus(200)
			 ->assertJson(['tag' => $testInput ]);

    	$this->assertDatabaseHas('objs', ['tag' => $testInput ]);
	}

	public function update_object_with_select($oldInput, $newInput)
	{
		$this->create_object_with_select($oldInput);

		$this->eloquentPost(ObjFillOne::find(1), ['tag' => $newInput])
			 ->assertStatus(200)
			 ->assertJson(['tag' => $newInput ]);

    	$this->assertDatabaseHas('objs', ['tag' => $newInput ]);
    	$this->assertDatabaseMissing('objs', ['tag' => $oldInput ]);
	}

	public function create_object_with_multiselect($testInput)
	{
		$this->eloquentPost(new ObjFillMany(), ['tags' => $testInput])
			 ->assertStatus(200)
			 ->assertJson(['tags' => $testInput ]);

    	$this->assertDatabaseHas('objs', ['tags' => json_encode($testInput) ]);
	}

	public function update_object_with_multiselect($oldInput, $newInput)
	{
		$this->create_object_with_multiselect($oldInput);

		$this->eloquentPost(ObjFillMany::find(1), ['tags' => $newInput])
			 ->assertStatus(200)
			 ->assertJson(['tags' => $newInput ]);

    	$this->assertDatabaseHas('objs', ['tags' => $newInput ? json_encode($newInput) : $newInput ]);
    	$this->assertDatabaseMissing('objs', ['tags' => json_encode($oldInput) ]);
	}
	
	public function create_object_with_select_belongsTo()
	{
		$obj = new Obj();
		$obj->title = 'test-input';
		$obj->save();
    	$this->assertDatabaseHas('objs', ['id' => $obj->id ]);

		$this->eloquentPost(new ObjBelongsTo(), [
				'obj' => $obj->id
			])
			 ->assertStatus(200)
			 ->assertJson([
			 	'obj_id' => $obj->id,
			 	'obj' => [
			 		'id' => $obj->id,
			 		'title' => 'test-input'
			 	]
			  ]);

    	$this->assertDatabaseHas('childobjs', ['obj_id' => $obj->id ]);

    	return $obj;
	}
	
	public function update_object_with_select_belongsTo()
	{
		$oldObj = $this->create_object_with_select_belongsTo();

		$obj = new Obj();
		$obj->title = 'test-input2';
		$obj->save();
    	$this->assertDatabaseHas('objs', ['id' => $obj->id ]);

		$this->eloquentPost(ObjBelongsTo::find(1), [
				'obj' => $obj->id
			])
			 ->assertStatus(200)
			 ->assertJson([
			 	'obj_id' => $obj->id,
			 	'obj' => [
			 		'id' => $obj->id,
			 		'title' => 'test-input2'
			 	] 
			 ]);

    	$this->assertDatabaseHas('childobjs', ['obj_id' => $obj->id ]);
    	$this->assertDatabaseMissing('childobjs', ['obj_id' => $oldObj->id ]);
	}
	
	public function create_object_with_select_belongsToMany()
	{
		$tag1 = new Tagbtm();$tag1->title = 'tag1'; $tag1->save();
		$tag2 = new Tagbtm();$tag2->title = 'tag2'; $tag2->save();
    	$this->assertDatabaseHas('tagbtms', ['id' => 1 ]);
    	$this->assertDatabaseHas('tagbtms', ['id' => 2 ]);
    	$this->assertDatabaseMissing('tagbtms', ['id' => 3 ]);

		$this->eloquentPost(new ObjBelongsToMany(), [
				'tagbtms' => [1,2]
			])
			 ->assertStatus(200)
			 ->assertJson([
			 	'tagbtms' => [
			 		['id' => 1],
			 		['id' => 2]
			 	]
			  ]);

    	$this->assertDatabaseHas('objs', ['id' => 1 ]);
    	$this->assertCount(2, Obj::find(1)->tagbtms);
	}
	
	public function update_object_with_select_belongsToMany()
	{
		$this->create_object_with_select_belongsToMany();
		$tag3 = new Tagbtm();$tag3->title = 'tag3'; $tag3->save();
    	$this->assertDatabaseHas('tagbtms', ['id' => 3 ]);

		$this->eloquentPost(ObjBelongsToMany::find(1), [
				'tagbtms' => [1,3]
			])
			 ->assertStatus(200)
			 ->assertJson([
			 	'tagbtms' => [
			 		['id' => 1],
			 		['id' => 3]
			 	]
			  ]);

    	$this->assertDatabaseHas('objs', ['id' => 1 ]);
    	$tagbtms = Obj::find(1)->tagbtms;

    	$this->assertCount(2, $tagbtms);
    	$this->assertEquals('tag1', $tagbtms[0]->title);
    	$this->assertEquals('tag3', $tagbtms[1]->title);
    	$this->assertDatabaseMissing('obj_tagbtm', ['tagbtm_id' => 2 ]);
	}
	
	public function create_object_with_select_morphToMany()
	{
		$tag1 = new Tagmtm();$tag1->title = 'tag1'; $tag1->save();
		$tag2 = new Tagmtm();$tag2->title = 'tag2'; $tag2->save();
    	$this->assertDatabaseHas('tagmtms', ['id' => 1 ]);
    	$this->assertDatabaseHas('tagmtms', ['id' => 2 ]);
    	$this->assertDatabaseMissing('tagmtms', ['id' => 3 ]);

		$this->eloquentPost(new ObjMorphToMany(), [
				'tagmtms' => [1,2]
			])
			 ->assertStatus(200)
			 ->assertJson([
			 	'tagmtms' => [
			 		['id' => 1],
			 		['id' => 2]
			 	]
			  ]);

    	$this->assertDatabaseHas('objs', ['id' => 1 ]);
    	$this->assertCount(2, Obj::find(1)->tagmtms);
	}
	
	public function update_object_with_select_morphToMany()
	{
		$this->create_object_with_select_morphToMany();
		$tag3 = new Tagmtm();$tag3->title = 'tag3'; $tag3->save();
    	$this->assertDatabaseHas('tagmtms', ['id' => 3 ]);

		$this->eloquentPost(ObjMorphToMany::find(1), [
				'tagmtms' => [1,3]
			])
			 ->assertStatus(200)
			 ->assertJson([
			 	'tagmtms' => [
			 		['id' => 1],
			 		['id' => 3]
			 	]
			  ]);

    	$this->assertDatabaseHas('objs', ['id' => 1 ]);
    	$tagmtms = Obj::find(1)->tagmtms;

    	$this->assertCount(2, $tagmtms);
    	$this->assertEquals('tag1', $tagmtms[0]->title);
    	$this->assertEquals('tag3', $tagmtms[1]->title);
    	$this->assertDatabaseMissing('obj_tagmtm', ['tagmtm_id' => 2 ]);
	}


}