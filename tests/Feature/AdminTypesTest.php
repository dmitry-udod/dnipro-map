<?php

namespace Tests\Feature;

use App\Type;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property array entity
 */
class AdminTypesTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'name' => 'Загальноміські заходи',
            'order' => '0',
            'color' => '#FFFFFF',
            'is_active' => true,
        ];
    }

    /** @test */
    public function types_list()
    {
        $this->admin()->get($this->route('/admin/types'))->assertStatus(200);
        $this->superadmin()->get($this->route('/admin/types'))->assertStatus(200);
    }

    /** @test */
    public function type_create_update()
    {
        $this->adminLviv()->get($this->route('/admin/types/create'))->assertStatus(200);
        $this->entity['city_id'] = $this->createCity()->id;
        $this->entity['category_id'] = $this->createCategory()->id;
        $this->adminLviv()->post($this->route('/admin/types'), $this->entity)->assertStatus(302);
        $this->adminLviv()->get($this->route('/admin/types'))->assertSee($this->entity['name']);
        $this->superadmin()->get($this->route('/admin/types'))->assertSee($this->entity['name']);
        $this->adminDnipro()->get($this->route('/admin/types'))->assertDontSee($this->entity['name']);

        $this->entity['name'] = 'Мафи';
        $this->adminLviv()->put($this->route('/admin/types/1'), $this->entity)->assertRedirect();
        $this->adminLviv()->get($this->route('/admin/types'))->assertSee($this->entity['name']);
    }

    /** @test */
    public function type_delete()
    {
        $this->superadmin()->delete($this->route('/admin/types/1'))->assertRedirect();
        $this->superadmin()->get($this->route('/admin/types'))->assertDontSee($this->entity['name']);
    }
}
