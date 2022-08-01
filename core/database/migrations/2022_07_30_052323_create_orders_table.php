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
            $table->text('cart');
            $table->integer('user_id');
            $table->text('user_info');
            $table->string('order_number');
            $table->string('method');
            $table->string('currency_name');
            $table->string('currency_value');
            $table->string('currency_sign');
            $table->string('txn_id');
            $table->integer('payment_status')->default(0);
            $table->integer('order_status')->default(0);
            $table->double('total')->default(0);
            $table->integer('qty')->default(0);
            $table->text('shipping_charge_info')->nullable();
            $table->string('invoice_number')->nullable();

            // billing
            $table->string('billing_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_number')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_zip')->nullable();
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
