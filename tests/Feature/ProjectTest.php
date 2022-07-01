<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use App\Models\Project as ProjectModel;
use App\Http\Livewire\Project\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function test_project_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('project.project');
    }

    /** @test  */
    public function test_component_can_load_projects()
    {
        $projects = ProjectModel::factory(3)->create();

        Livewire::test(Project::class)
            ->assertSee($projects->first()->name)
            ->assertSee($projects->first()->image)
            ->assertSee($projects->last()->name)
            ->assertSee($projects->last()->image);
    }

    /** @test  */
    public function test_user_can_see_all_project_info()
    {
        $project = ProjectModel::factory()->create([
            'name' => 'My super mega project',
            'description' => "This is a project prety special, because it's my first important work.",
            'image' => 'myproject.jpg',
            'video_link' => 'https://www.youtube.com/watch?v=K4TOrB7at0Y',
            'url' => 'https://www.cafedelprogramador.com/',
        ]);

        Livewire::test(Project::class)
            ->call('loadProject', $project->id)
            ->assertSee($project->name)
            ->assertSee($project->description)
            ->assertSee($project->video_code)
            ->assertSee($project->url);
    }

    /** @test  */
    public function test_only_admin_can_see_projects_actions()
    {
        $user = User::factory()->create();
        ProjectModel::factory(3)->create();

        Livewire::actingAs($user)->test(Project::class)
            ->assertStatus(200)
            ->assertSee(__('New Project'))
            ->assertSee(__('Edit'))
            ->assertSee(__('Delete'));
    }

    /** @test  */
    public function test_guests_cannot_see_projects_actions()
    {
        Livewire::test(Project::class)
            ->assertStatus(200)
            ->assertDontSee(__('Edit'))
            ->assertDontSee(__('New Project'))
            ->assertDontSee(__('Delete'));

        $this->assertGuest();
    }

    /** @test  */
    public function test_admin_can_add_a_project()
    {
        $user = User::factory()->create();
        $image = UploadedFile::fake()->image('myproject.jpg');
        Storage::fake('projects');

        Livewire::actingAs($user)->test(Project::class)
            ->set('currentProject.name', 'My new project')
            ->set('currentProject.description', 'Here a very nice description')
            ->set('imageFile', $image)
            ->set('currentProject.video_link', 'https://www.youtube.com/watch?v=K4TOrB7at0Y')
            ->set('currentProject.url', 'https://www.cafedelprogramador.com/')
            ->call('save');

        $newProject = ProjectModel::first();

        $this->assertDatabaseHas('projects', [
            'id' => $newProject->id,
            'name' => 'My new project',
            'description' => $newProject->description,
            'image' => $newProject->image,
            'video_link' => $newProject->video_link,
            'url' => $newProject->url,
        ]);

        Storage::disk('projects')->assertExists($newProject->image);
    }

    /** @test  */
    public function test_admin_can_edit_a_project()
    {
        $user = User::factory()->create();
        $project = ProjectModel::factory()->create();
        $img = UploadedFile::fake()->image('mysuperiamge.jpg');
        Storage::fake('projects');

        Livewire::actingAs($user)->test(Project::class)
            ->call('loadProject', $project->id)
            ->set('currentProject.name', 'My super project updated')
            ->set('currentProject.description', 'Software Developed with Laravel PHP and a lot of love')
            ->set('imageFile', $img)
            ->set('currentProject.video_link', 'https://www.youtube.com/watch?v=K4TOrB7at0Y')
            ->set('currentProject.url', 'https://www.cafedelprogramador.com/')
            ->call('save');

        $project->refresh();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'My super project updated',
            'description' => 'Software Developed with Laravel PHP and a lot of love',
            'image' => $project->image,
            'video_link' => $project->video_link,
            'url' => $project->url,
        ]);

        Storage::disk('projects')->assertExists($project->image);
    }

    /** @test  */
    public function test_admin_can_delete_a_project()
    {
        $user = User::factory()->create();
        $project = ProjectModel::factory()->create();
        $img = UploadedFile::fake()->image('myproject.jpg');
        Storage::fake('projects');

        Livewire::actingAs($user)->test(Project::class)
            ->call('loadProject', $project->id)
            ->set('imageFile', $img)
            ->call('save');

        $project->refresh();

        Livewire::actingAs($user)->test(Project::class)
            ->call('deleteProject', $project->id);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        Storage::disk('projects')->assertMissing($project->image);
    }

    /** @test  */
    public function test_name_is_required()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', '')
            ->set('currentProject.description', '......')
            ->call('save')
            ->assertHasErrors(['currentProject.name' => 'required']);
    }

    /** @test  */
    public function test_name_must_have_a_maximum_of_one_hundred_characters()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'abdcefghijklmnopqrstuabdcefghijklmnopqrstabdcefghijklmnopqrstuabdcefghijklmnopqrst1234567891234567891')
            ->set('currentProject.description', '......')
            ->call('save')
            ->assertHasErrors(['currentProject.name' => 'max']);
    }

    /** @test  */
    public function test_description_is_required()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'hahaha')
            ->set('currentProject.description', '')
            ->call('save')
            ->assertHasErrors(['currentProject.description' => 'required']);
    }

    /** @test  */
    public function test_description_must_have_a_maximum_of_two_hundred_fifty_characters()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'hehehe')
            ->set('currentProject.description', 'abdcefghijklmnopqrstuabdcefghijklmnopqrstabdcefghijklmnopqrstuabdcefghijklmnopqrst123456789123456789abdcefghijklmnopqrstuabdcefghijklmnopqrstabdcefghijklmnopqrstuabdcefghijklmnopqrst123456789123456789abdcefghijklmnopqrstuabdcefghijklmnopqrstabdcefghij')
            ->call('save')
            ->assertHasErrors(['currentProject.description' => 'max']);
    }

    /** @test  */
    public function test_image_file_must_be_a_image()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'My super name')
            ->set('currentProject.description', 'My super description')
            ->set('imageFile', UploadedFile::fake()->create('myimagexd.pdf'))
            ->call('save')
            ->assertHasErrors(['imageFile' => 'image']);
    }

    /** @test  */
    public function test_image_file_must_be_max_one_megabyte()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'My super name')
            ->set('currentProject.description', 'My super description')
            ->set('imageFile', UploadedFile::fake()->image('myimagexd.jpg')->size(1025))
            ->call('save')
            ->assertHasErrors(['imageFile' => 'max']);
    }

    /** @test  */
    public function test_video_link_must_be_a_valid_url()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'My super name')
            ->set('currentProject.description', 'My super description')
            ->set('currentProject.video_link', 'https:/www.google.com')
            ->call('save')
            ->assertHasErrors(['currentProject.video_link' => 'url']);
    }

    /** @test  */
    public function test_video_link_must_match_with_regex()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'My super name')
            ->set('currentProject.description', 'My super description')
            ->set('currentProject.video_link', 'https://www.google.com')
            ->call('save')
            ->assertHasErrors(['currentProject.video_link' => 'regex']);
    }

    /** @test  */
    public function test_url_must_be_a_valid_url()
    {
        Livewire::test(Project::class)
            ->set('currentProject.name', 'My super name')
            ->set('currentProject.description', 'My super description')
            ->set('currentProject.url', 'https:/www.google.com')
            ->call('save')
            ->assertHasErrors(['currentProject.url' => 'url']);
    }
}
