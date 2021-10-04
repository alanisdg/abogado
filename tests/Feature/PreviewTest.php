<?php

namespace Tests\Feature;

use App\Imports\PreviewImport;
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

        $response = $this->actingAs($user)->get('/preview');

        $response->assertOk();

        $response->assertViewIs('modules.preview.preview');
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
