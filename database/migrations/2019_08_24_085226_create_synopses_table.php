<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSynopsesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('synopses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('team_id')->unique();
            $table->string('scrolls_id')->unique();
            $table->string('namespace');
            $table->text('pre_signed_url')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('synopses');
    }
}
