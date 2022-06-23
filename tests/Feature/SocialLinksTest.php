<?php

namespace Tests\Feature;

use App\Models\SocialLink as SocialLinkModel;
use App\Http\Livewire\Contact\SocialLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SocialLinksTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function test_social_link_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('contact.social-link');
    }

    /** @test  */
    public function test_component_can_load_social_links()
    {
        $links = SocialLinkModel::factory(4)->create();

        Livewire::test(SocialLink::class)
            ->assertSee($links->first()->url)
            ->assertSee($links->first()->icon)
            ->assertSee($links->last()->url)
            ->assertSee($links->last()->icon);
    }

    /** @test  */
    public function test_only_admin_can_see_social_links_actions()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->assertStatus(200)
            ->assertSee('Edit')
            ->assertSee('New');
    }

    /** @test  */
    /*public function test_guests_cannot_see_navigation_actions()
    {
        Livewire::test(SocialLink::class)
            ->assertStatus(200)
            ->assertDontSee('Edit')
            ->assertDontSee('New');

        $this->assertGuest();
    }*/

    /** @test  */
    public function test_admin_can_add_a_social_link()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLink.name', 'new social link')
            ->set('socialLink.url', 'https://mysocialprofile.com/gamg')
            ->call('save');

        $this->assertDatabaseHas('social_links', ['name' => 'new social link', 'url' => 'https://mysocialprofile.com/gamg']);
    }

    /** @test  */
    public function test_admin_can_edit_a_social_link()
    {
        $user = User::factory()->create();
        $socialLink = SocialLinkModel::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLinkSelected', $socialLink->id)
            ->set('socialLink.name', 'My super GitHub')
            ->set('socialLink.url', 'https://github.com/gamg')
            ->set('socialLink.icon', 'fa-brands fa-github')
            ->call('save');

        $socialLink->refresh();

        $this->assertDatabaseHas('social_links', [
            'id' => $socialLink->id,
            'name' => 'My super GitHub',
            'url' => 'https://github.com/gamg',
            'icon' => $socialLink->icon,
        ]);
    }

    /** @test  */
    public function test_admin_can_delete_a_project()
    {
        $user = User::factory()->create();
        $socialLink = SocialLinkModel::factory()->create();

        Livewire::actingAs($user)->test(SocialLink::class)
            ->set('socialLinkSelected', $socialLink->id)
            ->call('deleteSocialLink');

        $this->assertDatabaseMissing('social_links', ['id' => $socialLink->id]);
    }

    /** @test  */
    public function test_name_is_required()
    {
        Livewire::test(SocialLink::class)
            ->set('socialLink.name', '')
            ->set('socialLink.url', 'http://mysociallink.com')
            ->call('save')
            ->assertHasErrors(['socialLink.name' => 'required']);
    }

    /** @test  */
    public function test_name_must_have_a_maximum_of_twenty_characters()
    {
        Livewire::test(SocialLink::class)
            ->set('socialLink.name', '123456789012345678901')
            ->set('socialLink.url', 'https://mysociallink.com')
            ->call('save')
            ->assertHasErrors(['socialLink.name' => 'max']);
    }

    /** @test  */
    public function test_url_is_required()
    {
        Livewire::test(SocialLink::class)
            ->set('socialLink.name', 'SuperName')
            ->set('socialLink.url', '')
            ->call('save')
            ->assertHasErrors(['socialLink.url' => 'required']);
    }

    /** @test  */
    public function test_url_must_be_a_valid_url()
    {
        Livewire::test(SocialLink::class)
            ->set('socialLink.name', 'SuperName')
            ->set('socialLink.url', 'https:/mysociallink.com')
            ->call('save')
            ->assertHasErrors(['socialLink.url' => 'url']);
    }

    /** @test  */
    public function test_icon_must_match_with_regex()
    {
        Livewire::test(SocialLink::class)
            ->set('socialLink.name', 'My super name')
            ->set('socialLink.url', 'https://mysociallink.com')
            ->set('socialLink.icon', 'fa-fa fa-face-smile-wink')
            ->call('save')
            ->assertHasErrors(['socialLink.icon' => 'regex']);
    }
}
