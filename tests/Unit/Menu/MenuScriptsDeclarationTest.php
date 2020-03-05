<?php
namespace Vuravel\Components\Tests\Unit\Menu;

use Vuravel\Components\Tests\EnvironmentBoot;

class MenuScriptsDeclarationTest extends EnvironmentBoot
{
	/** @test */
	public function include_scripts_path_as_string()
	{
		\Route::view('assets-path-as-string', 'assets-path-as-string');

		$this->get('assets-path-as-string')
			->assertStatus(200)
			->assertSee('<script id="vl-js-1" src="https://example.org/script1.js"></script>');
	}

	/** @test */
	public function include_scripts_path_as_array()
	{
		\Route::view('assets-path-as-array', 'assets-path-as-array');

		$this->get('assets-path-as-array')
			->assertStatus(200)
			->assertSee('<script id="vl-js-1" src="https://example.org/script1.js"></script>')
			->assertSee('<script id="vl-js-2" src="https://example.org/script2.js"></script>')
			->assertSee('<script id="vl-js-3" src="https://example.org/script3.js"></script>');
	}

	/** @test */
	public function include_scripts_as_global_blade()
	{
		\Route::view('assets-global-blade-template', 'assets-global-blade-template');

		$this->get('assets-global-blade-template')
			->assertStatus(200)
			->assertSee('<script src="https://example.org/script4.js"></script>')
			->assertSee('<script src="https://example.org/script5.js"></script>');
	}

}