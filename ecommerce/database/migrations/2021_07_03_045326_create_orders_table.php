<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invID');
            $table->integer('userID');
            $table->text('userPhone');
            $table->text('order_note')->nullable();
            $table->text('ship_to_another_address')->nullable();
            $table->double('subtotal');
            $table->integer('shippingID');
            $table->double('shippingCrg');
            $table->double('couponDiscount')->nullable();
            $table->double('wallet_bl')->nullable();
            $table->string('payment_method');
            $table->string('transactionID')->nullable();
            $table->string('date');
            $table->string('order_status');
            $table->integer('order_cancel')->default('0');
            $table->string('cancel_by')->nullable();
            $table->mediumText('order_cancel_reason')->nullable();
            
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
        Schema::dropIfExists('orders');
    }
}
