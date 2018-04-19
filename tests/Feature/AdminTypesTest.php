<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTypesTest extends TestCase
{
    /** @test */
    public function types_list()
    {
        $this->admin()->get($this->route('/admin/types'))->assertStatus(200);
        $this->superadmin()->get($this->route('/admin/types'))->assertStatus(200);
    }

    /** @test */
    public function type_create()
    {
        $this->admin()->get($this->route('/admin/types/create'))->assertStatus(200);
    }

}
