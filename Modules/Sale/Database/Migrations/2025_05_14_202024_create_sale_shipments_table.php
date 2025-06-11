<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration // Renamed to avoid class name conflict
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sale_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
            $table->string('tracking_number')->nullable();
            $table->enum('shipping_option', ['JNE', 'JNT', 'SICEPAT', 'GOSEND'])->nullable();
            $table->enum('delivery_type', ['pickup', 'courier'])->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->text('destination_address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->integer('shipping_cost')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_shipments');
    }
};
