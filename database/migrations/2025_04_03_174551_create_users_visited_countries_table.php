<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_visited_countries', function (Blueprint $table) {
            $table->integer('id_user_country', true);
            $table->integer('id_user')->index('fk_user_visit_user');
            $table->integer('id_country')->index('fk_user_visit_country');
            $table->binary('photos');
            $table->string('description', 150)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('nb_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_visited_countries');
    }
};
