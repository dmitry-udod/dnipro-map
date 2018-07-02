<?php

namespace Tests\Feature;

use App\Claim;
use App\Mail\AdminMakeResponseOnUserClaim;
use Carbon\Carbon;
use Tests\Feature\Front\ClaimTest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

/**
 * @property array entity
 */
class AdminClaimTest extends TestCase
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
    public function claim_list()
    {
        $this->actingAs($this->asAdmin())->get($this->route('/admin/claims'))->assertStatus(200);
        $this->actingAs($this->asSuperAdmin())->get($this->route('/admin/claims'))->assertStatus(200);
    }

    /** @test */
    public function process_claim()
    {
        Mail::fake();

        $entity = $this->createClaim();
        $this->adminLviv()->get($this->route('/admin/claims'))->assertSee($entity->email);
        $this->adminLviv()->put($this->route("/admin/claims/{$entity->id}"), $this->entity)->assertRedirect();
        $entity = Claim::find($entity->id);

        $this->assertEquals($this->entity['response'], $entity->response);
        $this->assertEquals($this->asAdmin()->name, $entity->processed_by);
        $this->assertEquals(Carbon::now()->toDateTimeString(), $entity->processed_at);
        $this->assertTrue($entity->is_processed);

        Mail::assertSent(AdminMakeResponseOnUserClaim::class, 1);
    }

}
