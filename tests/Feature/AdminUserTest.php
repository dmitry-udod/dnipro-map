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
        $this->createCity();

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

        $this->adminLviv()->post($this->route('/admin/users/create'), [])
            ->assertStatus(200);
        
        // See new admin in list
        // $this->adminLviv()->post($this->route('/admin/users/create'), [])
            // ->assertStatus(200);

    }
}
