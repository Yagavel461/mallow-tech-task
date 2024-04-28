<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_histories', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing primary key
            $table->string('purchase_id');
            $table->string('customer_email');
            $table->decimal('total_price', 8, 2);
            $table->decimal('total_tax', 8, 2);
            $table->string('payment_method')->default('cash');
            $table->enum('status', ['completed', 'pending', 'cancelled'])->default('completed');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('purchase_histories');
    }
}
