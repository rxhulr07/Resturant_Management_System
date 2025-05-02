<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->enum('status', ['pending', 'paid', 'ready', 'collected'])->default('pending');
            $table->string('payment_id')->nullable();
            $table->timestamp('pickup_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plates');
    }
}; 