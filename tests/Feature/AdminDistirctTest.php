<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property array entity
 */
class AdminDistrictTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'name' => 'Чечелевський',
            'is_active' => true,
        ];
    }

    /** @test */
    public function district_list()
    {
        $this->actingAs($this->asAdmin())->get($this->route('/admin/districts'))->assertStatus(200);
        $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/districts'))->assertStatus(200);
    }

    /** @test */
    public function create_district()
    {
        $this->admin()->get($this->route('/admin/districts/create'))->assertStatus(200);
        $this->entity['city_id'] = $this->createCity()->id;

        $this->adminLviv()->post($this->route('/admin/districts'), $this->entity)->assertStatus(302);
        $this->adminLviv()->get($this->route('/admin/districts'))->assertSee($this->entity['name']);
        $this->superadmin()->get($this->route('/admin/districts'))->assertSee($this->entity['name']);
        $this->adminDnipro()->get($this->route('/admin/districts'))->assertDontSee($this->entity['name']);

        $this->entity['name'] = 'Центр';
        $this->adminLviv()->put($this->route('/admin/districts/1'), $this->entity)->assertRedirect();
        $this->adminLviv()->get($this->route('/admin/districts'))->assertSee($this->entity['name']);
    }

    /** @test */
    public function distirct_delete()
    {
        $this->superadmin()->delete($this->route('/admin/districts/1'))->assertRedirect();
        $this->superadmin()->get($this->route('/admin/districts'))->assertDontSee($this->entity['name']);
    }
}
