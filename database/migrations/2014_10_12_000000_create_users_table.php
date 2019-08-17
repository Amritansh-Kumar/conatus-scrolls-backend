<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('team_id');
            $table->string('name');
            $table->string('mob_no');
            $table->string('college');
            $table->boolean('hostel_accomodation');
            $table->enum('status', [User::LEADER, User::MEMBER]);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('team_name');
            $table->string('domain');
            $table->string('topic');
            $table->string('member1_name');
            $table->string('member1_email')->unique();
            $table->string('member2_name')->default(0);
            $table->string('member2_email')->unique()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
