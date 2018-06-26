<?php

namespace Tests\Feature\Front;

use App\Claim;
use App\StructureRequest;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewStructureTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'name' => 'Dima Udod',
            'email' => 'reedwalter24@gmail.com',
            'description'  => 'Very nice place',
            'address'  => 'Baiker Street 36',
            'latitude' => '1',
            'longitude' => '2',
        ];
    }

    /** @test */
    public function create_claim_from_user()
    {
        $this->entity['category_id'] = $this->createCategory()->id;
        $this->post($this->route('/new-structures/create'), $this->entity);
        $this->assertCount(1, StructureRequest::all());
    }
}
