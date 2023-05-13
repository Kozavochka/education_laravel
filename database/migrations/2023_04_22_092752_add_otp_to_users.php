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
        Schema::table('users', function (Blueprint $table) {
            //$table->id();

            $table->integer('otp')->nullable();//one time password
            $table->integer('attempts')->default(3);//attempts use otp

//            $table->dropColumn('name');
            $table->dropColumn('password');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('otp');
            $table->dropColumn('attempts');

            //$table->string('name');
            $table->string('password');
        });
    }
};
