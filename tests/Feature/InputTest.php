<?php
namespace Vuravel\Components\Tests\Feature;

use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjFillOne;
use Vuravel\Components\Tests\Models\Obj;

class InputTest extends EnvironmentBoot
{

	/** @test */
	public function receive_valid_input_from_request()
	{
		$testInput = 'test-input';

		$this->simplePost([ 'input' => $testInput ])
			 ->assertStatus(200)
			 ->assertJson([ 'input' => $testInput ]);
	}

	/** @test */
	public function receive_invalid_input_response()
	{
		$testInput = 'test-input-long-input';

		$this->simplePost([ 'input' => $testInput ])
			 ->assertStatus(422)
			 ->assertJson([ 'errors' => ['input' => []] ]);
	}

	/** @test */
	public function create_object_with_non_empty_input()
	{
		$this->create_object_with_input('test-input');
	}

	/** @test */
	public function update_object_with_non_empty_input()
	{
		$this->update_object_with_input('test-input', 'test-input-new');
	}

	/** @test */
	public function update_object_with_empty_input()
	{
		$this->update_object_with_input('test-input', null);
	}

	/**********************************************
	*********   Refactored Assertions *************
	***********************************************/

	public function create_object_with_input($testInput)
	{
		$this->eloquentPost(new ObjFillOne(), ['title' => $testInput])
			 ->assertStatus(200)
			 ->assertJson(['title' => $testInput ]);

    	$this->assertDatabaseHas('objs', ['title' => $testInput ]);
	}

	public function update_object_with_input($oldInput, $newInput)
	{
		$this->create_object_with_input($oldInput);

		$this->eloquentPost(ObjFillOne::find(1), ['title' => $newInput])
			 ->assertStatus(200)
			 ->assertJson(['title' => $newInput ]);

    	$this->assertDatabaseHas('objs', ['title' => $newInput ]);
    	$this->assertDatabaseMissing('objs', ['title' => $oldInput ]);
	}


}