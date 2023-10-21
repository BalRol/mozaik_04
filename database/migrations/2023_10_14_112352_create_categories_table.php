<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->text('description')->nullable();
            $table->timestamps(0);
        });

        DB::statement("ALTER TABLE event
                       ADD CONSTRAINT event_category_foreign
                       FOREIGN KEY (type)
                       REFERENCES category(name)
                       ON DELETE CASCADE;");
        $data = [
            ['Business & Networking', 'Events related to business networking, conferences, workshops, and seminars.'],
            ['Technology', 'Events related to technology, such as tech conferences, hackathons, and product launches.'],
            ['Arts & Entertainment', 'Events in the arts and entertainment category, including concerts, theater performances, and art exhibitions.'],
            ['Sports & Fitness', 'Sporting events, fitness classes, marathons, and tournaments.'],
            ['Education', 'Workshops, webinars, lectures, and educational events.'],
            ['Health & Wellness', 'Events focused on physical and mental health, wellness, and mindfulness.'],
            ['Food & Drink', 'Food festivals, wine tastings, cooking classes, and restaurant openings.'],
            ['Charity & Causes', 'Events for charitable causes, fundraising, and community service.'],
            ['Family & Kids', 'Events suitable for families and children, including festivals and fun activities.'],
            ['Music', 'Concerts, music festivals, and live performances.'],
            ['Travel & Outdoor', 'Events related to travel, outdoor activities, and adventure.'],
            ['Fashion & Beauty', 'Fashion shows, beauty workshops, and product launches.'],
            ['Science & Nature', 'Science-related events, nature expeditions, and astronomy gatherings.'],
            ['Hobbies & Special Interests', 'Events related to specific hobbies, interests, or fandoms.'],
            ['Conferences & Conventions', 'Industry-specific conferences, conventions, and trade shows.'],
            ['Religion & Spirituality', 'Religious and spiritual gatherings, ceremonies, and retreats.'],
            ['Community & Social', 'Local community events, social gatherings, and meetups.'],
            ['Automotive', 'Car shows, races, and automotive-related events.'],
            ['Gaming', 'Video game tournaments, board game nights, and gaming conventions.'],
            ['Miscellaneous', "Events that don't fit into any specific category."],
        ];

        foreach ($data as $item) {
            DB::table('category')->insert([
                'name' => $item[0],
                'description' => $item[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropForeign(['type']);
        });

        Schema::dropIfExists('category');
    }

};
