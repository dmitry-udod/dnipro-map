<?php

namespace Tests\Feature\Front;

use App\Mail\PreviousRecordCreatedNotifyAdmin;
use App\PreviousRecord;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PreviousRecordTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();

        $this->entity = [
            'name' => 'Dima Udod',
            'age' => '11',
            'parent_name' => 'Igor Udod',
            'parent_phone' => '+38093000000',
            'date' => '24/08/2018',
            'notes' => 'Some notes'
        ];
    }

    /** @test */
    public function create_record_from_user()
    {
        Mail::fake();

        $structure = $this->createStructure();
        $this->entity['structure_id'] = $structure->uuid;
        $this->post($this->route('/previous-record/create'), $this->entity)->assertStatus(500);

        $structure->is_previous_record_available = true;
        $structure->save();
        $this->post($this->route('/previous-record/create'), $this->entity)->assertOk();

        $this->assertCount(1, PreviousRecord::all());

        Mail::assertSent(PreviousRecordCreatedNotifyAdmin::class, 1);
    }
}
