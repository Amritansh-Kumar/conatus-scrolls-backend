<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('mob_no')->unique()->nullable();
            $table->string('college')->nullable();
            $table->boolean('hostel_accomodation')->default(false);
            $table->enum('status', [User::LEADER, User::MEMBER])->default(User::MEMBER);
            $table->string('email')->unique();
            $table->string('scrolls_id');
            $table->string('password');
            $table->boolean('registered')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
