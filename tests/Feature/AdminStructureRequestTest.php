<?php

namespace Tests\Feature;

use App\Mail\AdminMakeResponseOnStructureRequest;
use App\Structure;
use App\StructureRequest;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

/**
 * @property array entity
 */
class AdminStructureRequestTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'response' => 'Some Response',
        ];
    }

    /** @test */
    public function entities_list()
    {
        $this->actingAs($this->asAdmin())->get($this->route('/admin/structurerequests'))->assertStatus(200);
        $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/structurerequests/'))->assertStatus(200);
    }

    /** @test */
    public function process_request()
    {
        Mail::fake();

        $entity = $this->createStructureRequest();
        $this->adminLviv()->get($this->route('/admin/structurerequests'))->assertSeeText($entity->email);
        $this->adminDnipro()->get($this->route('/admin/structurerequests'))->assertDontSeeText($entity->email);
        $this->adminLviv()->put($this->route("/admin/structurerequests/{$entity->id}"), $this->entity)->assertRedirect();

        $entity = StructureRequest::find($entity->id);
        $this->assertEquals($this->entity['response'], $entity->response);
        $this->assertEquals($this->asAdmin()->name, $entity->processed_by);
        $this->assertEquals(Carbon::now()->toDateTimeString(), $entity->processed_at);
        $this->assertTrue($entity->is_processed);

        Mail::assertSent(AdminMakeResponseOnStructureRequest::class, 1);
    }

    /** @test */
    public function create_structure_from_request()
    {
        $structuresCount = Structure::count();
        $entity = $this->createStructureRequest();
        $this->adminLviv()->get($this->route('/admin/structures/create-from-request/' . $entity->id))->assertRedirect();
        $lastStructure = Structure::orderBy('id', 'DESC')->first();
        $this->assertEquals($structuresCount + 1, Structure::count());
        $this->assertEquals($lastStructure->city_id, $entity->city_id);
        $this->assertEquals($lastStructure->address, $entity->address);
        $this->assertEquals($lastStructure->latitude, $entity->latitude);
        $this->assertEquals($lastStructure->longitude, $entity->longitude);
        $this->assertTrue($lastStructure->is_active);
    }

}
