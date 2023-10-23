<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cookie;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateEvent()
    {
        $user = User::factory()->create();
        $this->withCookie('user',$user->id);

        // Tesztadatok
        $data = [
            "nameInput" => "My Event",
            "start_date" => "2023-12-01",
            "end_date" => "2023-12-02",
            "location" => "Test Location",
            "type" => "Music",
            "visibility" => "Public",
            "description" => "Test Description",
        ];

        // Teszt HTTP kérés
        $response = $this->post('/event', $data);
        $response->assertStatus(200);
        $response->assertJson(['message' => 10]);

        $this->assertDatabaseHas('event', [
            'name' => 'My Event',
            'start_date' => '2023-12-01',
            'end_date' => '2023-12-02',
            'location' => 'Test Location',
            'type' => 'Music',
            'visibility' => 'Public',
            'description' => 'Test Description',
        ]);

        $this->assertDatabaseHas('userEvent', [
            'user_id' => $user->id,
        ]);
    }

    public function testIndex()
        {
            $user = User::factory()->create();
            $this->withCookie('user', $user->id);
            $event = Event::factory()->create([
                'user_id' => $user->id,
                'name' => 'Test Name',
                'start_date' => '2023-12-01',
                'end_date' => '2023-12-02',
                'location' => 'Test Location',
                'image' => null,
                'type' => 'Music',
                'visibility' => 'Public',
                'description' => 'Test Description',
            ]);


            $searchData = [
                'search' => 'Test Event',
            ];

            $response = $this->get('/event', $searchData);
            $response->assertStatus(200);
            $response->assertJson([
                'event' => [
                    [
                        'id' => $event->id,
                        'user_id' => $user->id,
                        'name' => 'Test Name',
                        'start_date' => '2023-12-01',
                        'end_date' => '2023-12-02',
                        'location' => 'Test Location',
                        'image' => null,
                        'type' => 'Music',
                        'description' => 'Test Description',
                        'visibility' => 'Public',
                        'username' => $user->username,
                        'userImage' => null,
                        'is_interested' => null,
                    ],
                ],
            ]);
        }

}
