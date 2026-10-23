<?php

namespace Tests\Feature\MS_Admin;

use App\Models\MS_Category;
use App\Models\MS_Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_an_event(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = MS_Category::factory()->create();

        $response = $this->actingAs($admin)->post(
            route('admin.events.store'),
            $this->validEventData($category)
        );

        $response->assertRedirect(route('admin.events.index'));
        $this->assertDatabaseHas('events', [
            'title' => 'Community Technology Meetup',
            'category_id' => $category->id,
            'created_by' => $admin->id,
            'is_free' => true,
            'price' => null,
        ]);
    }

    public function test_event_creation_requires_a_title(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = MS_Category::factory()->create();
        $eventData = $this->validEventData($category);
        $eventData['title'] = '';

        $response = $this->actingAs($admin)->post(route('admin.events.store'), $eventData);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('events', 0);
    }

    public function test_event_end_date_cannot_be_before_its_start_date(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = MS_Category::factory()->create();
        $eventData = $this->validEventData($category);
        $eventData['end_date'] = now()->addDays(2)->format('Y-m-d H:i:s');

        $response = $this->actingAs($admin)->post(route('admin.events.store'), $eventData);

        $response->assertSessionHasErrors('end_date');
        $this->assertDatabaseCount('events', 0);
    }

    public function test_guests_cannot_access_event_creation(): void
    {
        $this->get(route('admin.events.create'))
            ->assertRedirect(route('login'));

        $category = MS_Category::factory()->create();

        $this->post(route('admin.events.store'), $this->validEventData($category))
            ->assertRedirect(route('login'));
    }

    public function test_non_admin_users_cannot_access_event_creation(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('admin.events.create'))
            ->assertForbidden();
    }

    public function test_factory_events_are_visible_in_the_upcoming_events_listing(): void
    {
        $event = MS_Event::factory()->create();

        $this->get(route('events.index'))
            ->assertOk()
            ->assertSee($event->title);
    }

    private function validEventData(MS_Category $category): array
    {
        $startDate = now()->addDays(5)->startOfHour();

        return [
            'title' => 'Community Technology Meetup',
            'description' => 'A gathering for local technology enthusiasts.',
            'start_date' => $startDate->format('Y-m-d H:i:s'),
            'end_date' => $startDate->copy()->addHours(2)->format('Y-m-d H:i:s'),
            'place' => 'Community Hall',
            'capacity' => 40,
            'price' => 0,
            'category_id' => $category->id,
        ];
    }
}
