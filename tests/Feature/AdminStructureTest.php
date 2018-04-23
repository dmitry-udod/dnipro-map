<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property array entity
 */
class AdminStructureTest extends TestCase
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
    public function structure_list()
    {
        $this->actingAs($this->asAdmin())->get($this->route('/admin/structures'))->assertStatus(200);
        $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/structures'))->assertStatus(200);
    }
}
