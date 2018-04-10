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
        // $this->actingAs($this->asUser())->get('/admin/applications')->assertStatus(302);
        // $this->actingAs($this->asSuperAdmin())->get('/admin/applications')->assertStatus(302);
        // $this->actingAs($this->asAdmin())->get('/admin/applications')->assertStatus(200);
    }

    /** @test */
    public function different_roles_access()
    {
        // $response = $this->get('http://dnipro.localhost');

        // $response->assertStatus(200);
    }
}
