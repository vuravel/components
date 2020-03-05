<?php
namespace Vuravel\Components\Tests\Unit\Menu;

use Vuravel\Components\Tests\EnvironmentBoot;

class MenuStylesDeclarationTest extends EnvironmentBoot
{
	/** @test */
	public function include_style_path_as_string()
	{
		\Route::view('assets-path-as-string', 'assets-path-as-string');

		$this->get('assets-path-as-string')
			->assertStatus(200)
			->assertSee('<link id="vl-css-1" href="https://example.org/style1.css" rel="stylesheet">');
	}

	/** @test */
	public function include_styles_path_as_array()
	{
		\Route::view('assets-path-as-array', 'assets-path-as-array');

		$this->get('assets-path-as-array')
			->assertStatus(200)
			->assertSee('<link id="vl-css-1" href="https://example.org/style1.css" rel="stylesheet">')
			->assertSee('<link id="vl-css-2" href="https://example.org/style2.css" rel="stylesheet">')
			->assertSee('<link id="vl-css-3" href="https://example.org/style3.css" rel="stylesheet">');
	}

	/** @test */
	public function include_styles_as_global_blade()
	{
		\Route::view('assets-global-blade-template', 'assets-global-blade-template');

		$this->get('assets-global-blade-template')
			->assertStatus(200)
			->assertSee('<link href="https://example.org/style4.css" rel="stylesheet">')
			->assertSee('<link href="https://example.org/style5.css" rel="stylesheet">');
	}

}