<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cookie;

class EventControllerTest extends TestCase
{
    public function testCreateEvent()
    {
        $user = User::factory()->create();
        $this->withCookie('user', $user->id);
        // Elkészítjük a tesztadatokat
        $data = [
            'nameInput' => 'Sample Event',
            'start_date' => '2023-12-01',
            'end_date' => '2023-12-02',
            'location' => 'Sample Location',
            'type' => 'Music',
            'visibility' => 'Public',
            'description' => 'Sample Description',
            'allowed_users' => '',
        ];

        // Manuálisan létrehozunk egy HTTP POST kérést
        $response = $this->call('POST', '/createEvent', $data);

        // Ellenőrizzük, hogy a válasz státuszkódja 200 (OK)
        $this->assertEquals(200, $response->status());

        // Ellenőrizzük a válasz JSON tartalmát
        $responseArray = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => 10], $responseArray);

        // Az adatbázisban megkeressük az eseményt és ellenőrizzük, hogy létezik-e
        $this->assertDatabaseHas('events', [
            'name' => 'Sample Event',
            'start_date' => '2023-12-01',
            'end_date' => '2023-12-02',
            'location' => 'Sample Location',
            'type' => 'Music',
            'description' => 'Sample Description',
            'visibility' => 'Public',
            'allowed_users' => '',
        ]);

        // Az adatbázisban megkeressük az eseményhez tartozó UserEvent rekordokat és ellenőrizzük, hogy léteznek
        $this->assertDatabaseHas('userEvent', [
            'user_id' => $user->id,
        ]);
    }

    // További tesztekhez további metódusokat készíthetsz, például a lekérdezési metódusok teszteléséhez.
}
