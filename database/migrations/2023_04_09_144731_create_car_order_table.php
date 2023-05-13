<?php

use App\Models\Car;
use App\Models\Order;
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
        Schema::create('car_order', function (Blueprint $table) {
            $table->id();
            //foreignIdFor связь с классами
            // связь многие ко многим

            $table->foreignIdFor(Car::class);
            $table->foreignIdFor(Order::class);

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
        Schema::dropIfExists('car_order');
    }
};
