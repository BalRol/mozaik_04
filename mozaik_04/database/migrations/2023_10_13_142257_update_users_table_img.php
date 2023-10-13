<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
         DB::statement("ALTER TABLE user MODIFY image LONGBLOB");
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->binary('image')->nullable()->change();
        });
    }
};
