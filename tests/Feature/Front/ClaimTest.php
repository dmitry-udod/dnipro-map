<?php

namespace Tests\Feature\Front;

use App\Claim;
use App\Mail\UserCreatedClaim;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClaimTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'name' => 'Dima Udod',
            'phone' => '+380938300000',
            'email' => 'reedwalter24@gmail.com',
            'category' => 1,
            'description'  => 'Very nice place',
            'photos' => [ UploadedFile::fake()->image('claim.jpg')],
        ];
    }

    /** @test */
    public function create_claim_from_user()
    {
        Mail::fake();

        $structure = $this->createStructure();
        $this->entity['structure_id'] = $structure->uuid;
        $this->post($this->route('/claims/create'), $this->entity);
        $this->assertCount(1, Claim::all());
        // ToDo: Check uploaded files /uploads/claims/1

        Mail::assertSent(UserCreatedClaim::class, 1);
    }
}
