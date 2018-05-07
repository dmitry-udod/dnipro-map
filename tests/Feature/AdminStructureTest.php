<?php

namespace Tests\Feature;

use App\Structure;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property array entity
 */
class AdminStructureTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'address' => "Дмитра Галицького 2",
            'category_id' => 1,
            'type_id' => 1,
            'is_active' => true,
            'is_free'  => false,
            'latitude' => "48.4697571",
            'longitude' => "34.9357767",
        ];
    }

    /** @test */
    public function structure_list()
    {
        $this->admin()->get($this->route('/admin/structures'))->assertStatus(200);
        $this->superadmin()->get($this->route('/admin/structures'))->assertStatus(200);
    }

    /** @test */
    public function structure_add_photo()
    {
        Storage::fake('public');
        $response = $this->actingAs($this->asAdmin())->post($this->route('/admin/structures/upload'), [
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ])->assertStatus(200);

        $this->assertNotEmpty($response->json()['data'][0]['name']);

        $response = $this->actingAs($this->asAdmin())->post($this->route('/admin/structures/upload-remove'), [
            'name' => $response->json()['data'][0]['name']
        ])->assertStatus(200);

        $this->assertEquals('Файл видалено', $response->json()['message']);
    }

    /** @test */
    public function structure_cant_create_without_coordinates()
    {
        $data = $this->entity;
        unset($data['latitude']);
        unset($data['longitude']);
        $this->superadmin()->post($this->route('/admin/structures'), $data)->assertStatus(302);
        $this->superadmin()->get($this->route('/admin/structures'))->assertDontSeeText($this->entity['address']);
    }

    /** @test */
    public function structure_create()
    {
        $this->superadmin()->post($this->route('/admin/structures'), $this->entity)->assertStatus(302);
        $this->superadmin()->get($this->route('/admin/structures'))->assertSeeText($this->entity['address']);
        $this->assertCount(1, Structure::all());
    }
}
