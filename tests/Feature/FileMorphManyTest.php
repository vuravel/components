<?php
namespace Vuravel\Components\Tests\Feature;

use Illuminate\Http\UploadedFile;
use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjMorphMany;
use Vuravel\Components\Tests\Models\{Obj, Filemm};
use Illuminate\Database\Eloquent\Collection;

class FileMorphManyTest extends EnvironmentBoot
{
	use Traits\FileTestsHelpers;
	
	protected $model = Filemm::class;
	protected $column = 'path';

	/** @test */
	public function update_has_many_uploaded_files_on_object()
	{
		$this->add_has_many_files_on_object([
			UploadedFile::fake()->create('filemm-upf1.pdf'),
			UploadedFile::fake()->create('filemm-upf2.pdf'),
		]);
		$oldObj = Obj::find(1)->load('filemms');
		$newFile = UploadedFile::fake()->create('filemm-upf3.pdf');
		$testFiles = [$oldObj->filemms[0], $newFile];

		$this->eloquentPost(ObjMorphMany::find(1), ['filemms' => [
				json_encode($testFiles[0]),
				$testFiles[1]
			]])
			 ->assertStatus(200)
			 ->assertJson(['filemms' => [
			 	$this->get_file_info_as_array($testFiles[0]),
			 	$this->get_file_info_as_array($testFiles[1]),
			 ]]);

	    $this->assert_database_has_files($testFiles, Obj::find(1), 'filemms');
	    $this->assertDatabaseHas('filemms', ['id' => 1 ]);
	    $this->assertDatabaseMissing('filemms', ['id' => 2 ]);
	    $this->assertDatabaseHas('filemms', ['id' => 3 ]);
        $this->assert_files_are_in_storage($testFiles);
    	$this->assert_file_is_missing($oldObj->filemms[1]);
	}

	/** @test */
	public function update_has_many_empty_files_on_object()
	{
		$this->add_has_many_files_on_object([
			UploadedFile::fake()->create('filemm-upf1.pdf'),
			UploadedFile::fake()->create('filemm-upf2.pdf'),
		]);
		$oldObj = Obj::find(1)->load('filemms');

		$this->eloquentPost(ObjMorphMany::find(1), ['filemms' => null])
			 ->assertStatus(200)
			 ->assertJson(['filemms' => null]);

	    $this->assertDatabaseMissing('filemms', ['id' => 1 ]);
	    $this->assertDatabaseMissing('filemms', ['id' => 2 ]);
    	$this->assert_file_is_missing($oldObj->filemms[0]);
    	$this->assert_file_is_missing($oldObj->filemms[1]);

	}

	/**********************************************
	***********  Refactored Assertions ************
	***********************************************/

	private function add_has_many_files_on_object($testFiles)
	{
		$this->eloquentPost(new ObjMorphMany(), ['filemms' => $testFiles])
			 ->assertStatus(200)
			 ->assertJson(['filemms' => [
			 	$this->get_file_info_as_array($testFiles[0]),
			 	$this->get_file_info_as_array($testFiles[1])
			 ]])
			 ->assertJsonCount(2, 'filemms');

	    $this->assert_database_has_files($testFiles, Obj::find(1), 'filemms');
	    $this->assertDatabaseHas('filemms', ['id' => 1 ]);
	    $this->assertDatabaseHas('filemms', ['id' => 2 ]);
        $this->assert_files_are_in_storage($testFiles);
	}

	private function assert_database_has_files($uploadedFiles, $parentModel, $relation)
	{
		$dbFiles = $parentModel->{$relation};
		$this->assertTrue($dbFiles instanceOf Collection);
		$this->assertTrue($dbFiles->count() > 0);
		foreach ($uploadedFiles as $key => $uploadedFile) {
			$this->assert_database_has_file_info($uploadedFile, $dbFiles[$key], $parentModel->id);
		}
	}

	private function assert_database_has_file_info($uploadedFile, $dbFile, $parentModelId)
	{
		$this->assertIsObject($dbFile);
		$this->assertTrue($parentModelId == $dbFile->model_id);
		$this->assertTrue(Obj::class == $dbFile->model_type);
		foreach ($this->get_file_info_as_array($uploadedFile) as $key => $value) {
        	$this->assertTrue($dbFile->{$key} == $value);
		}
	}

}