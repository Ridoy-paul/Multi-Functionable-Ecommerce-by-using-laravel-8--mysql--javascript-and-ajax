<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('logo');
            $table->string('address');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email');
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkden')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('mission_and_vission')->nullable();
            $table->string('popup_modal_title')->nullable();
            $table->string('popup_modal_description')->nullable();
            $table->longText('popup_modal_image')->nullable();
            $table->string('minimum_point_to_convert')->nullable();
            $table->string('point_to_tk_convert_rate')->nullable();
            $table->string('purchase_point')->nullable();
            $table->string('minimum_purchase_amount_in_tk_use_wallet_bl')->nullable();
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
        Schema::dropIfExists('shop_settings');
    }
}
