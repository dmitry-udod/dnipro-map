<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    /** @test */
    public function structure_add_photo()
    {
        Storage::fake('public');
        $response = $this->actingAs($this->asAdmin())->post($this->route('/admin/structures/upload'), [
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ]);
        // dd();
// dd($files = Storage::files('public'));
        // dd($response->json())    ;
        // Storage::disk('photos')->assertExists(public_path('uploads/structures/') . $response->json()['data'][0]['name']);
        // Storage::disk('public')->assertExists(public_path('uploads/structures/photo.jpg'));
        // $response->json()['data'][0]['name'])
    }
}
