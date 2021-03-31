<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->unsignedBigInteger('order_id')
                ->comment('オーダーID');
            $table
                ->unsignedBigInteger('standard_id')
                ->comment('規格ID');
            $table
                ->unsignedInteger('quantity')
                ->default(0)
                ->comment('数量');
            $table
                ->unsignedInteger('unit_price')
                ->default(0)
                ->comment('単価');
            $table
                ->float('tax')
                ->default(0.0)
                ->comment('税');
            $table
                ->unsignedInteger('shipping')
                ->default(0)
                ->comment('送料');
            $table
                ->timestamps();

            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table
                ->foreign('standard_id')
                ->references('id')
                ->on('product_standards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
