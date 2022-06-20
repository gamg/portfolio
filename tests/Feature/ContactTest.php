<?php

namespace Tests\Feature;

use App\Http\Livewire\Contact\Contact;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function test_contact_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('contact.contact');
    }

    /** @test  */
    public function test_component_can_load_contact_email()
    {
        $contact = PersonalInformation::factory()->create();

        Livewire::test(Contact::class)
            ->assertSee($contact->email);
    }

    /** @test  */
    public function test_only_admin_can_see_contact_action()
    {
        $user = User::factory()->create(['email' => 'adolfz10@gmail.com']);

        Livewire::actingAs($user)->test(Contact::class)
            ->assertStatus(200)
            ->assertSee('Edit');
    }

    /** @test  */
    /*public function test_guests_cannot_see_contact_action()
    {
        Livewire::test(Contact::class)
            ->assertStatus(200)
            ->assertDontSee('Edit');

        $this->assertGuest();
    }*/

    /** @test  */
    public function test_admin_can_edit_contact_email()
    {
        $user = User::factory()->create();

        $contact = PersonalInformation::factory()->create();

        Livewire::actingAs($user)->test(Contact::class)
            ->set('contact.email', 'tavo@cafedelprogramador.com')
            ->call('edit');

        $this->assertDatabaseHas('personal_information', [
            'id' => $contact->id,
            'email' => 'tavo@cafedelprogramador.com'
        ]);
    }

    /** @test  */
    public function test_contact_email_is_required()
    {
        Livewire::test(Contact::class)
            ->set('contact.email', '')
            ->call('edit')
            ->assertHasErrors(['contact.email' => 'required']);
    }

    /** @test  */
    public function test_contact_email_must_be_a_valid_email()
    {
        Livewire::test(Contact::class)
            ->set('contact.email', 'tavo@cdp')
            ->call('edit')
            ->assertHasErrors(['contact.email' => 'email']);
    }
}
