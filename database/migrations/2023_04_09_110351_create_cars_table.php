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

    /* загрузка сущности */
    public function up()
    {
        //https://goo.su/ENjQjx - про Schema
        // здесь нужно указывать имя таблицы для сущности
        Schema::create('cars', function (Blueprint $table) {

            $table->id();
            /* создание новых полей */
            /* уникальное*/
            $table->string('name')->unique();
            /* nullable - необязательный */
            $table->unsignedInteger('year')->nullable();
            $table->boolean('is_new')->default(1);
            //создание двух полей(временных) - создание и добавление
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /* откат. то что создали - должны удалить
    rollback - откат миграции по batch*/

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
