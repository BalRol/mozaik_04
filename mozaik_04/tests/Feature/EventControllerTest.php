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
        // Létrehozunk egy teszt felhasználót az adatbázisban
        $user = new User([
            'username' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'), // A jelszót megfelelően titkosítjuk
        ]);
        $user->save();
        Cookie::queue('user', $user->id);

        // Elkészítjük a tesztadatokat
        $data = [
            'nameInput' => 'Sample Event',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-02',
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
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-02',
            'location' => 'Sample Location',
            'type' => 'Sample Type',
            'description' => 'Sample Description',
            'visibility' => 'Public',
        ]);

        // Az adatbázisban megkeressük az eseményhez tartozó UserEvent rekordokat és ellenőrizzük, hogy léteznek
        $this->assertDatabaseHas('user_events', [
            'user_id' => $user->id,
        ]);
    }

    // További tesztekhez további metódusokat készíthetsz, például a lekérdezési metódusok teszteléséhez.
}
