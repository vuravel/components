<?php
namespace Vuravel\Components\Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjHasMany;
use Vuravel\Components\Tests\Models\Filehm;
use Vuravel\Components\Tests\Models\Obj;

class FileHasManyTest extends EnvironmentBoot
{
	use Traits\FileTestsHelpers;
	
	protected $model = Filehm::class;
	protected $column = 'path';

	/** @test */
	public function update_has_many_uploaded_files_on_object()
	{
		$this->add_has_many_files_on_object([
			UploadedFile::fake()->create('filehm-upf1.pdf'),
			UploadedFile::fake()->create('filehm-upf2.pdf'),
		]);
		$oldObj = Obj::find(1)->load('filehms');
		$newFile = UploadedFile::fake()->create('filehm-upf3.pdf');
		$testFiles = [$oldObj->filehms[0], $newFile];

		$this->eloquentPost(ObjHasMany::find(1), ['filehms' => [
				json_encode($testFiles[0]),
				$testFiles[1]
			]])
			 ->assertStatus(200)
			 ->assertJson(['filehms' => [
			 	$this->get_file_info_as_array($testFiles[0]),
			 	$this->get_file_info_as_array($testFiles[1]),
			 ]]);

	    $this->assert_database_has_files($testFiles, Obj::find(1), 'filehms');
	    $this->assertDatabaseHas('filehms', ['id' => 1 ]);
	    $this->assertDatabaseMissing('filehms', ['id' => 2 ]);
	    $this->assertDatabaseHas('filehms', ['id' => 3 ]);
        $this->assert_files_are_in_storage($testFiles);
    	$this->assert_file_is_missing($oldObj->filehms[1]);
	}

	/** @test */
	public function update_has_many_empty_files_on_object()
	{
		$this->add_has_many_files_on_object([
			UploadedFile::fake()->create('filehm-upf1.pdf'),
			UploadedFile::fake()->create('filehm-upf2.pdf'),
		]);
		$oldObj = Obj::find(1)->load('filehms');

		$this->eloquentPost(ObjHasMany::find(1), ['filehms' => null])
			 ->assertStatus(200)
			 ->assertJson(['filehms' => null]);

	    $this->assertDatabaseMissing('filehms', ['id' => 1 ]);
	    $this->assertDatabaseMissing('filehms', ['id' => 2 ]);
    	$this->assert_file_is_missing($oldObj->filehms[0]);
    	$this->assert_file_is_missing($oldObj->filehms[1]);

	}

	/**********************************************
	***********  Refactored Assertions ************
	***********************************************/

	private function add_has_many_files_on_object($testFiles)
	{
		$this->eloquentPost(new ObjHasMany(), ['filehms' => $testFiles])
			 ->assertStatus(200)
			 ->assertJson(['filehms' => [
			 	$this->get_file_info_as_array($testFiles[0]),
			 	$this->get_file_info_as_array($testFiles[1])
			 ]])
			 ->assertJsonCount(2, 'filehms');

	    $this->assert_database_has_files($testFiles, Obj::find(1), 'filehms');
	    $this->assertDatabaseHas('filehms', ['id' => 1 ]);
	    $this->assertDatabaseHas('filehms', ['id' => 2 ]);
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
		$this->assertTrue($parentModelId == $dbFile->obj_id);
		foreach ($this->get_file_info_as_array($uploadedFile) as $key => $value) {
        	$this->assertTrue($dbFile->{$key} == $value);
		}
	}

}