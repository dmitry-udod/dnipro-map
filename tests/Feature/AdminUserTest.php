<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminUserTest extends TestCase
{
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

        $data = [
            'name' => 'Pavlo Zibrov',
            'email' => 'pavlo@gmail.com',
            'password' => '12345678a',
            'roles' => 'admin',
            'cities' => (string)$lviv->id,
        ];

        $this->adminLviv()->post($this->route('/admin/users'), $data)->assertRedirect();


        $this->adminLviv()->get($this->route('/admin/users'))->assertSee($data['name']);
        $this->adminDnipro()->get($this->route('/admin/users'))->assertDontSee($data['name']);
        $this->superadmin()->get($this->route('/admin/users'))->assertSee($data['name']);
    }
}
