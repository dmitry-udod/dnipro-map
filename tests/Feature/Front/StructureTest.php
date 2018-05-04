<?php

namespace Tests\Feature\Front;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property array entity
 */
class StructureTest extends TestCase
{
    /** @test */
    public function structure_categories()
    {
        $city = $this->createCity();
        $category = $this->createCategory();
        $this->get($this->route('/'))->assertStatus(200);
        $this->get($this->route('/categories/' . $category->slug, $city->slug))->assertStatus(200);
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
}
