<?php
namespace Vuravel\Components\Tests\Feature;

use Illuminate\Http\UploadedFile;
use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjHasOne;
use Vuravel\Components\Tests\Models\Obj;
use Vuravel\Components\Tests\Models\Fileho;

class FileHasOneTest extends EnvironmentBoot
{
	use Traits\FileTestsHelpers;
	
	protected $model = Fileho::class;
	protected $column = 'path';

	/** @test */
	public function update_a_has_one_uploaded_file_on_object()
	{
		$this->add_a_has_one_file_on_object(UploadedFile::fake()->create('fileho-upf.pdf'));
		$oldObj = Obj::find(1)->load('fileho');
		$newFile = UploadedFile::fake()->create('word.psd');

		$this->eloquentPost(ObjHasOne::find(1), ['fileho' => $newFile])
			 ->assertStatus(200)
			 ->assertJson(['fileho' => $this->get_file_info_as_array($newFile) ]);

	    $this->assert_database_has_file_info($newFile, Obj::find(1), 'fileho');
        $this->assert_file_is_in_storage($newFile);
    	$this->assert_file_is_missing($oldObj->fileho);
	}

	/** @test */
	public function update_a_has_one_json_file_on_object()
	{
		$this->add_a_has_one_file_on_object(UploadedFile::fake()->create('fileho-json.pdf'));
		$oldObj = Obj::find(1)->load('fileho');

		$this->eloquentPost(ObjHasOne::find(1), ['fileho' => $oldObj->fileho])
			 ->assertStatus(200)
			 ->assertJson(['fileho' => $this->get_file_info_as_array($oldObj->fileho) ]);

	    $this->assert_database_has_file_info($oldObj->fileho, Obj::find(1), 'fileho');
        $this->assert_file_is_in_storage($oldObj->fileho);
	}

	/** @test */
	public function update_a_has_one_empty_file_on_object()
	{
		$this->add_a_has_one_file_on_object(UploadedFile::fake()->create('fileho-empty.pdf'));
		$oldObj = Obj::find(1)->load('fileho');
	    $this->assertDatabaseHas('filehos', ['id' => 1 ]);

		$this->eloquentPost(ObjHasOne::find(1), ['fileho' => null])
			 ->assertStatus(200)
			 ->assertJson(['fileho' => null ]);

	    $this->assertDatabaseMissing('filehos', ['id' => 1 ]);
    	$this->assert_file_is_missing($oldObj->fileho);

	}

	/**********************************************
	***********  Refactored Assertions ************
	***********************************************/

	private function add_a_has_one_file_on_object($testFile)
	{
		$this->eloquentPost(new ObjHasOne(), ['fileho' => $testFile])
			 ->assertStatus(200)
			 ->assertJson(['fileho' => $this->get_file_info_as_array($testFile) ]);

	    $this->assert_database_has_file_info($testFile, Obj::find(1), 'fileho');
        $this->assert_file_is_in_storage($testFile);
	}

	private function assert_database_has_file_info($uploadedFile, $parentModel, $relation)
	{
		$dbFile = $parentModel->{$relation};
		$this->assertIsObject($dbFile);
		$this->assertTrue($parentModel->id == $dbFile->obj_id);
		foreach ($this->get_file_info_as_array($uploadedFile) as $key => $value) {
        	$this->assertTrue($dbFile->{$key} == $value);
		}
	}

}