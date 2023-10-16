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
        });

        DB::statement("ALTER TABLE event
                       ADD CONSTRAINT event_category_foreign
                       FOREIGN KEY (type)
                       REFERENCES category(name)
                       ON DELETE CASCADE;");
    }

    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropForeign(['type']);
        });

        Schema::dropIfExists('category');
    }

};
