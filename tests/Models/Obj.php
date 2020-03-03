<?php
namespace Vuravel\Components\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vuravel\Components\Tests\Models\Filemtm;
use Vuravel\Components\Tests\Models\Imagemtm;
use Vuravel\Components\Tests\Models\Multiformmtm;
use Vuravel\Components\Tests\Models\Placemtm;
use Vuravel\Components\Tests\Models\Tagmtm;

class Obj extends Model
{
	protected $casts = [
        'tags' => 'array',
        'file' => 'array',
        'image' => 'array',
        'place' => 'array',
        'multiform' => 'array'
    ];

    /********** BelongsToMany **********/
	public function tagbtms()
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Tagbtm')->withTimestamps();
	}

	public function filebtms()
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Filebtm')->withTimestamps();
	}

	public function imagebtms()
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Imagebtm')->withTimestamps();
	}

	public function placebtms()
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Placebtm')->withTimestamps();
	}

	public function multiformbtms()
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Multiformbtm')->withTimestamps();
	}


	/********** HasMany **********/
	public function filehms()
	{
		return $this->hasMany('Vuravel\Components\Tests\Models\Filehm');
	}

	public function imagehms()
	{
		return $this->hasMany('Vuravel\Components\Tests\Models\Imagehm');
	}

	public function placehms()
	{
		return $this->hasMany('Vuravel\Components\Tests\Models\Placehm');
	}

	public function multiformhms()
	{
		return $this->hasMany('Vuravel\Components\Tests\Models\Multiformhm');
	}


	/********** HasOne **********/
	public function fileho()
	{
		return $this->hasOne('Vuravel\Components\Tests\Models\Fileho');
	}

	public function imageho()
	{
		return $this->hasOne('Vuravel\Components\Tests\Models\Imageho');
	}

	public function placeho()
	{
		return $this->hasOne('Vuravel\Components\Tests\Models\Placeho');
	}

	public function multiformho()
	{
		return $this->hasOne('Vuravel\Components\Tests\Models\Multiformho');
	}

	/********** MorphOne **********/
	public function filemo()
	{
		return $this->morphOne('Vuravel\Components\Tests\Models\Filemo', 'model');
	}

	public function imagemo()
	{
		return $this->morphOne('Vuravel\Components\Tests\Models\Imagemo', 'model');
	}

	public function placemo()
	{
		return $this->morphOne('Vuravel\Components\Tests\Models\Placemo', 'model');
	}

	public function multiformmo()
	{
		return $this->morphOne('Vuravel\Components\Tests\Models\Multiformmo', 'model');
	}


	/********** MorphMany **********/
	public function filemms()
	{
		return $this->morphMany('Vuravel\Components\Tests\Models\Filemm', 'model');
	}

	public function imagemms()
	{
		return $this->morphMany('Vuravel\Components\Tests\Models\Imagemm', 'model');
	}

	public function placemms()
	{
		return $this->morphMany('Vuravel\Components\Tests\Models\Placemm', 'model');
	}

	public function multiformmms()
	{
		return $this->morphMany('Vuravel\Components\Tests\Models\Multiformmm', 'model');
	}

    /********** MorphToMany **********/
	public function tagmtms()
	{
		return $this->morphToMany(Tagmtm::class, 'model', 'obj_tagmtm')->withTimestamps();
	}

	public function filemtms()
	{
		return $this->morphToMany(Filemtm::class, 'model', 'obj_filemtm')->withTimestamps();
	}

	public function imagemtms()
	{
		return $this->morphToMany(Imagemtm::class, 'model', 'obj_imagemtm')->withTimestamps();
	}

	public function placemtms()
	{
		return $this->morphToMany(Placemtm::class, 'model', 'obj_placemtm')->withTimestamps();
	}

	public function multiformmtms()
	{
		return $this->morphToMany(Multiformmtm::class, 'model', 'obj_multiformmtm')->withTimestamps();
	}


}
