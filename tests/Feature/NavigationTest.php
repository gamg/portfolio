<?php

namespace Tests\Feature;

use App\Http\Livewire\Navigation\Navigation;
use App\Http\Livewire\Navigation\Item;
use App\Models\Navitem;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function test_navigation_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('navigation.navigation');
    }

    /** @test  */
    public function test_item_component_can_be_rendered()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user)->test(Item::class)->assertStatus(200);
    }

    /** @test  */
    public function test_component_can_load_items_navigation()
    {
        $items = Navitem::factory(3)->create();

        Livewire::test(Navigation::class)
            ->assertSee($items->first()->label)
            ->assertSee($items->last()->label);
    }

    /** @test  */
    public function test_only_admin_can_see_navigation_actions()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user)->test(Navigation::class)
            ->assertStatus(200)
            ->assertSee(__('Edit'))
            ->assertSee(__('New'));
    }

    /** @test  */
    public function test_guests_cannot_see_navigation_actions()
    {
        Livewire::test(Navigation::class)
            ->assertStatus(200)
            ->assertDontSee(__('Edit'))
            ->assertDontSee(__('New'));

        $this->assertGuest();
    }

    /** @test  */
    public function test_admin_can_add_an_item()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', 'new item')
            ->set('item.link', '#')
            ->call('save');

        $this->assertDatabaseHas('navitems', ['label' => 'new item', 'link' => '#']);
    }

    /** @test  */
    public function test_admin_can_edit_items()
    {
        $user = User::factory()->create();

        // Firstly, I save a couple of items
        $items = Navitem::factory(2)->create();

        // and then, I edit those items
        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.label', 'My Projects')
            ->set('items.0.link', '#super-projects')
            ->set('items.1.label', 'Get in touch')
            ->set('items.1.link', '#get-in-touch')
            ->call('edit');

        $this->assertDatabaseHas('navitems', ['id' => $items->first()->id, 'label' => 'My Projects', 'link' => '#super-projects']);
        $this->assertDatabaseHas('navitems', ['id' => $items->last()->id, 'label' => 'Get in touch', 'link' => '#get-in-touch']);
    }

    /** @test  */
    public function test_admin_can_delete_a_item()
    {
        $user = User::factory()->create();
        $item = Navitem::factory()->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->call('deleteItem', $item);

        $this->assertDatabaseMissing('navitems', ['id' => $item->id]);
    }

    /** @test  */
    public function test_label_is_required()
    {
        Livewire::test(Item::class)
            ->set('item.label', '')->set('item.link', '#projects')->call('save')
            ->assertHasErrors(['item.label' => 'required']);
    }

    /** @test  */
    public function test_label_must_have_a_maximum_of_twenty_characters()
    {
        Livewire::test(Item::class)
            ->set('item.label', 'abdcefghijklmnopqrstu')->set('item.link', '#projects')->call('save')
            ->assertHasErrors(['item.label' => 'max']);
    }

    /** @test  */
    public function test_link_is_required()
    {
        Livewire::test(Item::class)
            ->set('item.label', 'Label')->set('item.link', '')->call('save')
            ->assertHasErrors(['item.link' => 'required']);
    }

    /** @test  */
    public function test_link_must_have_a_maximum_of_forty_characters()
    {
        Livewire::test(Item::class)
            ->set('item.label', 'My label')->set('item.link', 'www.abcdefghijklmnopqrstuvwxyz.com/abcdef')->call('save')
            ->assertHasErrors(['item.link' => 'max']);
    }

    /** @test */
    public function test_items_is_required()
    {
        // We can do this test for every rule

        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', 'Work')
            ->set('item.link', '#projects')
            ->call('save');

        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.label', '')->set('items.0.link', '#projects')->call('edit')
            ->assertHasErrors(['items.0.label' => 'required']);
    }
}
