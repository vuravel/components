<?php
namespace Vuravel\Components\Tests\Feature;

use Illuminate\Http\UploadedFile;
use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjMorphOne;
use Vuravel\Components\Tests\Models\Obj;
use Vuravel\Components\Tests\Models\Filemo;

class FileMorphOneTest extends EnvironmentBoot
{
	use Traits\FileTestsHelpers;
	
	protected $model = Filemo::class;
	protected $column = 'path';

	/** @test */
	public function update_a_morph_one_uploaded_file_on_object()
	{
		$this->add_a_morph_one_file_on_object(UploadedFile::fake()->create('filemo-upf.pdf'));
		$oldObj = Obj::find(1)->load('filemo');
		$newFile = UploadedFile::fake()->create('filemo-upf2.psd');

		$this->eloquentPost(ObjMorphOne::find(1), ['filemo' => $newFile])
			 ->assertStatus(200)
			 ->assertJson(['filemo' => $this->get_file_info_as_array($newFile) ]);

	    $this->assert_database_has_file_info($newFile, Obj::find(1), 'filemo');
        $this->assert_file_is_in_storage($newFile);
    	$this->assert_file_is_missing($oldObj->filemo);
	}

	/** @test */
	public function update_a_morph_one_json_file_on_object()
	{
		$this->add_a_morph_one_file_on_object(UploadedFile::fake()->create('filemo-json.pdf'));
		$oldObj = Obj::find(1)->load('filemo');

		$this->eloquentPost(ObjMorphOne::find(1), ['filemo' => $oldObj->filemo])
			 ->assertStatus(200)
			 ->assertJson(['filemo' => $this->get_file_info_as_array($oldObj->filemo) ]);

	    $this->assert_database_has_file_info($oldObj->filemo, Obj::find(1), 'filemo');
        $this->assert_file_is_in_storage($oldObj->filemo);
	}

	/** @test */
	public function update_a_morph_one_empty_file_on_object()
	{
		$this->add_a_morph_one_file_on_object(UploadedFile::fake()->create('filemo-empty.pdf'));
		$oldObj = Obj::find(1)->load('filemo');
	    $this->assertDatabaseHas('filemos', ['id' => 1 ]);

		$this->eloquentPost(ObjMorphOne::find(1), ['filemo' => null])
			 ->assertStatus(200)
			 ->assertJson(['filemo' => null ]);

	    $this->assertDatabaseMissing('filemos', ['id' => 1 ]);
    	$this->assert_file_is_missing($oldObj->filemo);

	}

	/**********************************************
	***********  Refactored Assertions ************
	***********************************************/

	private function add_a_morph_one_file_on_object($testFile)
	{
		$this->eloquentPost(new ObjMorphOne(), ['filemo' => $testFile])
			 ->assertStatus(200)
			 ->assertJson(['filemo' => $this->get_file_info_as_array($testFile) ]);

	    $this->assert_database_has_file_info($testFile, Obj::find(1), 'filemo');
        $this->assert_file_is_in_storage($testFile);
	}

	private function assert_database_has_file_info($uploadedFile, $parentModel, $relation)
	{
		$dbFile = $parentModel->{$relation};
		$this->assertIsObject($dbFile);
		$this->assertTrue($parentModel->id == $dbFile->model_id);
		$this->assertTrue(Obj::class == $dbFile->model_type);
		foreach ($this->get_file_info_as_array($uploadedFile) as $key => $value) {
        	$this->assertTrue($dbFile->{$key} == $value);
		}
	}

}