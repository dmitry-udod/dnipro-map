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
        $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/cities'))->assertSee('dnipro');
    }
}
