<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCityTest extends TestCase
{
    /** @test */
    public function cities_can_view_only_superadmin()
    {
        $this->actingAs($this->asAdmin())->get($this->route('/admin/cities'))->assertStatus(403);
        $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/cities'))->assertStatus(200);
    }

    /** @test */
    public function create_city()
    {

        $this->superadmin()->get($this->route('/admin/cities/create'))->assertStatus(200);

        $this->superadmin()->post($this->route('/admin/cities'), ['name' => 'Черкаси'])->assertRedirect();
        $this->superadmin()->get($this->route('/admin/cities'))->assertSee('cherkasi');

        //Check is new city available on front
        $this->superadmin()->get('http://cherkasi.localhost')->assertStatus(200);
    }

    /** @test */
    public function update_city()
    {
        $this->superadmin()->put($this->route('/admin/cities/2'), ['name' => 'Черкаси2', 'slug' => 'cherkasi'])->assertRedirect();
        $this->superadmin()->get($this->route('/admin/cities'))->assertSee('Черкаси2');
    }

    /** @test */
    public function delete_city()
    {
        $this->superadmin()->delete($this->route('/admin/cities/2'))->assertRedirect();
        $this->superadmin()->get($this->route('/admin/cities'))->assertDontSee('Черкаси2');
    }
}
