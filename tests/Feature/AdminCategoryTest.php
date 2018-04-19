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

        $this->superadmin()->post($this->route('/admin/categories'), [
                'name' => 'МАФ',
                'city_id' => 1,
                'is_active' => true,
                'order' => 0,
            ])
            ->assertRedirect()
            ;            
            $this->superadmin()->get($this->route('/admin/categories'))->assertSee('МАФ');
    }

    /** @test */
    public function admin_from_other_city_didnt_see_dnipro_categories()
    {
        $this->createCity();
        $this->createCategory();
        $this->adminLviv()->get($this->route('/admin/categories'))->assertDontSee('МАФ');
        $this->adminLviv()->get($this->route('/admin/categories'))->assertSee('New Year Trees');
    }
}