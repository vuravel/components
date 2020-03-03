<?php
namespace Vuravel\Components\Tests\Feature;

use Illuminate\Http\UploadedFile;
use Vuravel\Components\Tests\EnvironmentBoot;
use Vuravel\Components\Tests\Forms\ObjFillMany;
use Vuravel\Components\Tests\Forms\ObjFillOne;
use Vuravel\Components\Tests\Models\Obj;

class FileTest extends EnvironmentBoot
{
	use Traits\FileTestsHelpers;

	protected $model = Obj::class;
	protected $column = 'file';

	/** @test */
	public function receive_valid_file_from_request()
	{
		$testFile = UploadedFile::fake()->create('document.pdf');

		$this->simplePost([ 'file' => $testFile ])
			 ->assertStatus(200);

    	\Storage::assertExists('public/'.$testFile->name);
    	\Storage::assertMissing('public/anotherdocument.pdf');
	}

	/** @test */
	public function receive_valid_files_from_request()
	{
		$testFiles = [
			UploadedFile::fake()->create('document1.pdf'),
			UploadedFile::fake()->create('document2.pdf')
		];

		$this->simplePost([ 'files' => $testFiles ])
			 ->assertStatus(200);

    	\Storage::assertExists('public/'.$testFiles[0]->name);
    	\Storage::assertExists('public/'.$testFiles[1]->name);
    	\Storage::assertMissing('public/document3.pdf');
	}

	/** @test */
	public function receive_invalid_file_response()
	{
		$bigFile = UploadedFile::fake()->create('bigDocument.pdf', 1000); //1000KB

		$this->simplePost([ 'file' => $bigFile ])
			 ->assertStatus(422)
			 ->assertJson([ 'errors' => ['file' => []] ]);

    	\Storage::assertMissing('public/'.$bigFile->name);
	}

	/** @test */
	public function receive_invalid_files_response()
	{
		$bigFiles = [
			UploadedFile::fake()->create('validDocument.pdf', 99),
			UploadedFile::fake()->create('bigDocument2.pdf', 1000), //1000KB
		];

		$this->simplePost([ 'files' => $bigFiles ])
			 ->assertStatus(422)
			 ->assertJson([ 'errors' => ['files.1' => []] ]);


    	\Storage::assertMissing('public/'.$bigFiles[0]->name);
    	\Storage::assertMissing('public/'.$bigFiles[1]->name);
	}

	/** @test */
	public function update_object_with_uploaded_file()
	{
		$this->create_object_with_file(UploadedFile::fake()->create('document.pdf'));
	    $oldObj = Obj::find(1);
		$newFile = UploadedFile::fake()->create('word.psd');

		$this->eloquentPost(ObjFillOne::find(1), ['file' => $newFile])
			 ->assertStatus(200)
			 ->assertJson(['file' => $this->get_file_info_as_array($newFile) ]);

	    $this->assert_database_has_file_info($newFile, Obj::find(1)->file);
        $this->assert_file_is_in_storage($newFile);
    	$this->assert_file_is_missing($oldObj->file);
	}

	/** @test */
	public function update_object_with_json_file()
	{
		$this->create_object_with_file(UploadedFile::fake()->create('document.pdf'));
	    $oldObj = Obj::find(1);

		$this->eloquentPost(ObjFillOne::find(1), ['file' => $oldObj->file])
			 ->assertStatus(200)
			 ->assertJson(['file' => $this->get_file_info_as_array($oldObj->file) ]);

	    $this->assert_database_has_file_info($oldObj->file, Obj::find(1)->file);
        $this->assert_file_is_in_storage($oldObj->file);
	}

	/** @test */
	public function update_object_with_empty_file()
	{
		$this->create_object_with_file(UploadedFile::fake()->create('document.pdf'));
	    $oldObj = Obj::find(1);

		$this->eloquentPost(ObjFillOne::find(1), ['file' => null])
			 ->assertStatus(200)
			 ->assertJson(['file' => null]);

	    $this->assertDatabaseHas('objs', ['file' => null ]);
    	$this->assert_file_is_missing($oldObj->file);
	}

	/** @test */
	public function update_object_with_multiple_files()
	{
		$this->create_object_with_multiple_files([
			UploadedFile::fake()->create('multidoc1.pdf'),
			UploadedFile::fake()->create('multidoc2.pdf')
		]);
		$oldFiles = Obj::find(1)->file;
		$newFile = UploadedFile::fake()->create('multidoc3.pdf');
		$testFiles = [$oldFiles[0],$newFile];

		$this->eloquentPost(ObjFillMany::find(1), ['file' => [
				json_encode($oldFiles[0]),
				$newFile
			]])
			 ->assertStatus(200)
			 ->assertJson(['file' => [
			 	$this->get_file_info_as_array($oldFiles[0]),
			 	$this->get_file_info_as_array($newFile)
			 ]])
			 ->assertJsonCount(2, 'file');

	    $this->assert_database_has_files($testFiles, Obj::find(1)->file);
	    $this->assert_files_are_in_storage($testFiles);
    	$this->assert_file_is_missing($oldFiles[1]);
	}

	/**********************************************
	***********  Refactored Assertions ************
	***********************************************/

	private function create_object_with_file($testFile)
	{
		$this->eloquentPost(new ObjFillOne(), ['file' => $testFile])
			 ->assertStatus(200)
			 ->assertJson(['file' => $this->get_file_info_as_array($testFile) ]);

	    $this->assert_database_has_file_info($testFile, Obj::find(1)->file);
        $this->assert_file_is_in_storage($testFile);
	}

	public function create_object_with_multiple_files($testFiles)
	{
		$this->eloquentPost(new ObjFillMany(), ['file' => $testFiles])
			 ->assertStatus(200)
			 ->assertJson(['file' => [
			 	$this->get_file_info_as_array($testFiles[0]),
			 	$this->get_file_info_as_array($testFiles[1])
			 ]])
			 ->assertJsonCount(2, 'file');

	    $this->assert_database_has_files($testFiles, Obj::find(1)->file);
        $this->assert_files_are_in_storage($testFiles);
	}

	private function assert_database_has_file_info($uploadedFile, $dbFile)
	{
		$this->assertIsArray($dbFile);
		foreach ($this->get_file_info_as_array($uploadedFile) as $key => $value) {
        	$this->assertTrue($dbFile[$key] == $value);
		}
	}

	private function assert_database_has_files($uploadedFiles, $dbFiles)
	{
		foreach ($uploadedFiles as $key => $uploadedFile) {
			$dbFile = $dbFiles[$key];
			$this->assert_database_has_file_info($uploadedFile, $dbFile);
		}
	}




}