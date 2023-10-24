<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_employees', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('team_id');
            $table->string('email', 128);
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('password', 64);
            $table->char('gender', 1);
            $table->date('birthday');
            $table->string('avatar', 128);
            $table->integer('salary');
            $table->integer('position');
            $table->char('status', 1);
            $table->int('type_of_work');
            $table->integer('ins_id');
            $table->integer('upd_id');
            $table->dateTime('ins_datetime');
            $table->dateTime('upd_datetime');
            $table->char('del_flag', 1);
            $table->unique('email'); // Add a unique constraint on the email column if needed.
            
        });
       
    }

    /**
     * Reverse the migrations.      
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_employees');
    }
};
