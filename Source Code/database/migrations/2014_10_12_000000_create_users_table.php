<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->id();
            $table->string('email')->unique();
            $table->integer('mobile_n')->length(11)->unique();
            $table->string('password')->nullable(false);
            $table->string('jwt')->nullable();
            $table->string('email_verified_at')->default('NULL');
            $table->timestamp('exp_time')->nullable();
        
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
