<?php 

namespace Vuravel\Components\Tests\Feature\Traits;

use Illuminate\Http\UploadedFile;


trait FileTestsHelpers{

	/**********************************************
	***********  Refactored Assertions ************
	***********************************************/

	private function assert_files_are_in_storage($files)
	{
		foreach ($files as $file) {
			$this->assert_file_is_in_storage($file);
		}
	}

	private function assert_file_is_in_storage($file)
	{
		$fileInfo = $this->get_file_info_as_array($file);
    	\Storage::assertExists($this->get_storage_path().basename($fileInfo[config('vuravel.files_attributes.path')]));
	}

	private function assert_file_is_missing($file)
	{
		$fileInfo = $this->get_file_info_as_array($file);
    	\Storage::assertMissing($this->get_storage_path().basename($fileInfo[config('vuravel.files_attributes.path')]));
	}


	/**********************************************
	***********   Test helpers ********************
	***********************************************/

	private function get_file_info_as_array($file)
	{
		if($file instanceOf UploadedFile){
			return [
				$this->conf('name') => $file->getClientOriginalName(),
			 	$this->conf('path') => $this->get_public_directory().$file->hashName(),
				$this->conf('size') => $file->getClientSize(),
			 	$this->conf('mime_type') => $file->getClientMimeType()
			];
    	}else{
			return [
				$this->conf('id') => $this->fileAttr($file, 'id'),
				$this->conf('name') => $this->fileAttr($file, 'name'),
			 	$this->conf('path') => $this->fileAttr($file, 'path'),
				$this->conf('size') => $this->fileAttr($file, 'size'),
			 	$this->conf('mime_type') => $this->fileAttr($file, 'mime_type')
			];
    	}
	}

	private function conf($attribute)
	{
		return config('vuravel.files_attributes.'.$attribute);
	}

	private function fileAttr($file, $attr)
	{
		return $file[$this->conf($attr)] ?? $file->{$this->conf($attr)};
	}


	private function get_public_directory()
	{
		return "storage/".$this->get_sub_path();
	}

	private function get_storage_path()
	{
		return "public/".$this->get_sub_path();
	}

	private function get_sub_path()
	{
		$model = $this->model;
		$model = new $model();
		return "{$model->getConnection()->getName()}/{$model->getTable()}/{$this->column}/";
	}
}