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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id');
            $table->text('description');
            $table->bigInteger('price');
            $table->text('image');
            $table->text('owner_name');
            $table->bigInteger('phone');
            $table->text('address');
            $table->text('coordinates');
            $table->integer('is_publish'); // 0=no publish, 1=publish
            $table->integer('condition');  // 0=new, 1=used, 2=good second hand
            $table->integer('type');       // 0=for sell, 1=for buy, 2=for exchange
            $table->integer('views')->default(0);
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
        Schema::dropIfExists('items');
    }
};
