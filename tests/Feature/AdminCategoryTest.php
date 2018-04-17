<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCategoryTest extends TestCase
{
    /** @test */
    public function category_list()
    {
        $this->admin()->get($this->route('/admin/categories'))->assertStatus(200);
        $this->superadmin()->get($this->route('/admin/categories'))->assertStatus(200);
    }

    /** @test */
    public function create_category()
    {

        $this->admin()->get($this->route('/admin/categories/create'))
            ->assertStatus(200)
            ->assertDontSee('Днiпро')
        ;

        $this->superadmin()->get($this->route('/admin/categories/create'))
            ->assertStatus(200)
            ->assertSee('Днiпро')
            ;
    }
}
