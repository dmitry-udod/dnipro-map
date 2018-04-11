<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLoginTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function access_only_for_admins()
    {
        $this->get($this->route('/admin/home'))->assertStatus(302);
        $this->actingAs($this->asAnonymous())->get($this->route('/admin/home'))->assertStatus(302);
    }

    /** @test */
    public function different_roles_access()
    {
        $this->actingAs($this->asAdmin())->get($this->route('/admin/home'))->assertStatus(302);
         $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/home'))->assertStatus(200);
//         $this->actingAs($this->asAdmin())->get('/admin/applications')->assertStatus(302);
    }
}
