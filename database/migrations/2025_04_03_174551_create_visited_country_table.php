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
        Schema::create('visited_country', function (Blueprint $table) {
            $table->integer('id_user_country', true);
            $table->integer('id_user');
            $table->integer('id_country');
            $table->string('description');
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
        Schema::dropIfExists('visited_country');
    }
};
