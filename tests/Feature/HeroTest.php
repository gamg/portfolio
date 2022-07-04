<?php

namespace Tests\Feature;

use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Hero\Info;
use App\Http\Livewire\Hero\Image;

class HeroTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function test_hero_info_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('hero.info');
    }

    /** @test  */
    public function test_hero_image_component_can_be_rendered()
    {
        PersonalInformation::factory()->create();
        Livewire::test('hero.image')->assertStatus(200);
    }

    /** @test  */
    public function test_component_can_load_hero_information()
    {
        $info = PersonalInformation::factory()->create();

        Livewire::test(Info::class)
            ->assertSee($info->title)
            ->assertSee($info->description);
    }

    /** @test  */
    public function test_component_can_load_hero_image()
    {
        $info = PersonalInformation::factory()->create();

        Livewire::test(Image::class)
            ->assertSee($info->image);
    }

    /** @test  */
    public function test_only_admin_can_see_hero_action()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user)->test(Info::class)
            ->assertStatus(200)
            ->assertSee(__('Edit'));
    }

    /** @test  */
    public function test_guests_cannot_see_hero_action()
    {
        Livewire::test(Info::class)
            ->assertStatus(200)
            ->assertDontSee(__('Edit'));

        $this->assertGuest();
    }

    /** @test  */
    public function test_admin_can_edit_hero()
    {
        $user = User::factory()->create();

        $info = PersonalInformation::factory()->create();
        $hero = UploadedFile::fake()->image('myhero.jpg');
        $cv = UploadedFile::fake()->create('curriculum.pdf');
        Storage::fake('hero');
        Storage::fake('cv');

        Livewire::actingAs($user)->test(Info::class)
            ->set('info.title', 'Adolfo Gutierrez')
            ->set('info.description', 'Software Developer in Laravel PHP')
            ->set('cvFile', $cv)
            ->set('imageFile', $hero)
            ->call('edit');

        $info->refresh();

        $this->assertDatabaseHas('personal_information', [
            'id' => $info->id,
            'title' => 'Adolfo Gutierrez',
            'description' => 'Software Developer in Laravel PHP',
            'cv' => $info->cv,
            'image' => $info->image,
        ]);

        Storage::disk('hero')->assertExists($info->image);
        Storage::disk('cv')->assertExists($info->cv);
    }

    /** @test */
    public function test_can_download_cv()
    {
        Livewire::test(Info::class)
            ->call('download')
            ->assertFileDownloaded('my-cv.pdf');
    }

    /** @test  */
    public function test_title_is_required()
    {
        Livewire::test(Info::class)
            ->set('info.title', '')
            ->set('info.description', 'Software Developer in Laravel PHP')
            ->call('edit')
            ->assertHasErrors(['info.title' => 'required']);
    }

    /** @test  */
    public function test_title_must_have_a_maximum_of_eighty_characters()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'abdcefghijklmnopqrstuabdcefghijklmnopqrstabdcefghijklmnopqrstuabdcefghijklmnopqrs')
            ->set('info.description', 'My super description')
            ->call('edit')
            ->assertHasErrors(['info.title' => 'max']);
    }

    /** @test  */
    public function test_description_is_required()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'My super title')
            ->set('info.description', '')
            ->call('edit')
            ->assertHasErrors(['info.description' => 'required']);
    }

    /** @test  */
    public function test_description_must_have_a_maximum_of_two_hundred_fifty_characters()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'My super title')
            ->set('info.description', 'abdcefghijklmnopqrstuabdcefghimnoplqorstabdcabdcefghijklmnopqrstuabdcefghimnoplqorstsdsdabdceghijklmnopqrstuabdcefghijklmnopqefghijklmnopqrstuabdcefghimnoplqorstsdsdabdceghijklmnopqrstuabdcefghijklmnopqsdsdabdceghijklmnopqrstuabdcefghijklmnopqrstpabdcefghijklmcnopqrstuabdcefghijklmnopqrsthytrzxcvbnmlkj')
            ->call('edit')
            ->assertHasErrors(['info.description' => 'max']);
    }

    /** @test  */
    public function test_cv_file_must_be_a_pdf()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'My super title')
            ->set('info.description', 'My super description')
            ->set('cvFile', UploadedFile::fake()->image('myfilexd.jpg'))
            ->call('edit')
            ->assertHasErrors(['cvFile' => 'mimes']);
    }

    /** @test  */
    public function test_cv_file_must_be_max_one_megabyte()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'My super title')
            ->set('info.description', 'My super description')
            ->set('cvFile', UploadedFile::fake()->create('myfile.pdf', 1025))
            ->call('edit')
            ->assertHasErrors(['cvFile' => 'max']);
    }

    /** @test  */
    public function test_image_file_must_be_a_image()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'My super title')
            ->set('info.description', 'My super description')
            ->set('imageFile', UploadedFile::fake()->create('myimagexd.pdf'))
            ->call('edit')
            ->assertHasErrors(['imageFile' => 'image']);
    }

    /** @test  */
    public function test_image_file_must_be_max_one_megabyte()
    {
        Livewire::test(Info::class)
            ->set('info.title', 'My super title')
            ->set('info.description', 'My super description')
            ->set('imageFile', UploadedFile::fake()->image('myimagexd.jpg')->size(1025))
            ->call('edit')
            ->assertHasErrors(['imageFile' => 'max']);
    }
}
