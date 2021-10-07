<?php

namespace Tests\Feature;

use App\Imports\PreviewImport;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;
use Spatie\Permission\Models\Role as SpatieRole;
class PreviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_show_preview_view()
    {

        $this->seed();
         // first include all the normal setUp operations
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/list-preview');

        $response->assertOk();

        $response->assertViewIs('modules.preview.preview');
    }

    public function test_update_preview()
    {
        $this->withoutExceptionHandling();
        $this->seed();
         // first include all the normal setUp operations
        $user = User::find(1);
        $contact = Contact::find(1);

        $response = $this->actingAs($user)->post('/preview/update/'.$contact->id,[
            'state_id'=>2,
            'date'=>'2020-01-01',
            'rut'=>'111',
            'name'=>'Horacio',
            'hour_1'=>'8:00',
            'hour_2'=>'9:00',
            'comuna'=>'comuna',

        ]);

        $contact = Contact::find(1);
        $this->assertEquals($contact->state_id, 2);
        $this->assertEquals($contact->date, '2020-01-01');
        $this->assertEquals($contact->hour, '8:00 a 9:00');
        $this->assertEquals($contact->name, 'Horacio');
        $this->assertEquals($contact->comuna, 'comuna');

    }



    protected function getTestFile($fileName)
    {
        $file = new UploadedFile(
            base_path('tests/files/' . $fileName),
            $fileName,
            null,
            true
        );

        return ['file' => $file];
    }


}
