<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_main_page_for_valid_city()
    {
        $response = $this->get('http://dnipro.localhost');

        $response->assertStatus(200);
    }

    /** @test */
    public function show_exception_for_valid_city()
    {
        $response = $this->get('http://test.localhost');

        $response->assertStatus(404);
    }

    /** @test */
    public function pages_view()
    {
        $this->admin()->get($this->route('/admin/statistics'))->assertStatus(200);
        $this->admin()->get($this->route('/contacts'))->assertStatus(200);
    }
}
