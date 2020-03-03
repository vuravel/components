<?php

namespace Vuravel\Components\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Database\Eloquent\Factory;
use App\User;
use Vuravel\Form\Http\Requests\FormValidationRequest;
use Vuravel\Components\Tests\Forms\SimplePostForm;

class EnvironmentBoot extends TestCase
{
    public $user;

    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        //Require package routes and add a test POST route for FormValidationRequest
        $this->loadRoutes();

        //Migrations... (only dependency on Orchestra Package)
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        //Factories and user
        $this->loadFactories();
        $this->user = factory(User::class)->create();
    }

    /**
     * Setting up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:AY8IdjRIyYUgVAV22ZLOsYclc0aWKwuDgM/lJ95lZRk=');

        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('vuravel', [

            'default_date_format' => env('DEFAULT_DATE_FORMAT', 'Y-m-d'),

            'files_attributes' => [
                'id' => 'id',
                'name' => 'name',
                'path' => 'path',
                'mime_type' => 'mime_type',
                'size' => 'size'
            ],

            'locales' => [
                
            ],
        ]);
    }

    protected function loadFactories()
    {
        //User Factory from vuravel/auth
        $this->app->make(Factory::class)->load(__DIR__.'/../../auth/database/factories');

        //Vuravel/Form factories
        $this->app->make(Factory::class)->load(__DIR__.'/Factories');

    }

    /**
     * Load the routes needed to perform the tests
     * @return [type] [description]
     */
    protected function loadRoutes()
    {
        //Load package routes
        require(__DIR__.'/../../form/routes/web.php');

        //Add a test route for simulating POSTs
        \Route::post('test-post-route', function(FormValidationRequest $request){

            foreach ($request->file() as $file) {

                if(is_array($file)){
                    foreach ($file as $key => $f) {
                        $f->storeAs('public', $f->getClientOriginalName());
                    }
                }else{
                    $file->storeAs('public', $file->getClientOriginalName());
                }
            }
            return $request->except(['file','files']);
        })->name('test-post-route');
    }


    /**
     * Loads a simple form and performs a POST request to a route with FormValidationRequest
     * @param array $data
     * @return Response
     */
    protected function simplePost($data)
    {
        $form = new SimplePostForm();

        return $this->withHeaders([ 'X-Vuravel-Id' => $form->id ])
                    ->json('POST', route('test-post-route'), $data);
    }

    /**
     * Load an Eloquent form and perform a POST request with some data
     * @param  array $data
     * @param  Vuravel\Form\Form $form
     * @return Response
     */
    protected function eloquentPost($form, $data)
    {
        return $this->actingAs($this->user)
                    ->withHeaders([ 'X-Vuravel-Id' => $form->id ])
                    ->json('POST', route('vuravel-form.db.update'), $data);
    }


}