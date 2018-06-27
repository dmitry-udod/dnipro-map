<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property array entity
 */
class AdminUserTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'name' => 'Pavlo Zibrov',
            'email' => 'pavlo@gmail.com',
            'password' => '12345678gga',
            'roles' => 'admin',
        ];
    }

    /** @test */
    public function users_list()
    {
        $this->actingAs($this->asAnonymous())->get($this->route('/admin/users'))->assertStatus(302);
        $this->admin()->get($this->route('/admin/users'))->assertStatus(200);
        $this->superadmin()->get($this->route('/admin/users'))->assertStatus(200);
    }

    /** @test */
    public function users_create()
    {
        $lviv = $this->createCity();

        $this->adminLviv()->get($this->route('/admin/users/create'))
            ->assertStatus(200)
            ->assertDontSee('superadmin')
            ->assertDontSee('Днiпро')
            ->assertSee('Львiв')
        ;

        $this->superadmin()->get($this->route('/admin/users/create'))
            ->assertStatus(200)
            ->assertSee('superadmin')
            ->assertSee('Днiпро')
            ->assertSee('Львiв')
        ;

        $this->entity['cities'] = (string)$lviv->id;
        $this->adminLviv()->post($this->route('/admin/users'), $this->entity)->assertRedirect();


        $this->adminLviv()->get($this->route('/admin/users'))->assertSee($this->entity['name']);
        $this->adminDnipro()->get($this->route('/admin/users'))->assertDontSee($this->entity['name']);
        $this->superadmin()->get($this->route('/admin/users'))->assertSee($this->entity['name']);
    }

    /** @test */
    public function user_update()
    {
        $entity = $this->asAdmin();
        $entity['name'] = 'Poplavskii';
        $this->superadmin()->put($this->route('/admin/users/' . $entity->id), $this->entity)->assertRedirect();

        $this->superadmin()->get($this->route('/admin/users'))->assertSee($this->entity['name']);
    }

    /** @test */
    public function delete_city()
    {
        $entity = \App\User::find(1);
        $this->superadmin()->delete($this->route('/admin/users/' . $entity->id))->assertRedirect();
        $this->superadmin()->get($this->route('/admin/users'))->assertDontSee($entity->name);
    }
}
