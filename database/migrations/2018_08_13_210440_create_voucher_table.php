<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->dateTime('expires_at');
            $table->dateTime('used_at');
            $table->boolean('used');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('special_offer_id');
            $table->foreign('recipient_id')->references('id')->on('recipient');
            $table->foreign('special_offer_id')->references('id')->on('special_offer');
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
        Schema::dropIfExists('voucher');
    }
}
