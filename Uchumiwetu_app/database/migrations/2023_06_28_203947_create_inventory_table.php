<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products'); // Assuming the table name is 'products'
            $table->integer('quantity');
            $table->foreignId('order_id')->constrained('orders'); // Assuming the table name is 'orders'
            $table->foreignId('payment_method_id')->constrained('payment_methods'); // Assuming the table name is 'payment_methods'
            $table->foreignId('shipping_location_id')->constrained('shipping_locations'); // Assuming the table name is 'shipping_locations'
            $table->foreignId('customer_id')->constrained('customers'); // Assuming the table name is 'customers'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
}
