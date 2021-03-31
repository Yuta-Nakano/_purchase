<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_standards', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->unsignedBigInteger('product_id')
                ->comment('商品ID');
            $table
                ->text('name')
                ->unique()
                ->comment('規格名');
            $table
                ->text('code')
                ->unique()
                ->comment('規格コード');
            $table
                ->unsignedBigInteger('thumb_id')
                ->comment('サムネイルID');
            $table
                ->unsignedBigInteger('thumb_target_id')
                ->nullable()
                ->comment('サムネイル対象ID');
            $table
                ->string('status')
                ->default('private')
                ->comment('ステータス [
                    private,
                    publish,
                ]');
            $table
                ->integer('stock')
                ->default(-1)
                ->comment('在庫');
            $table
                ->unsignedInteger('price')
                ->default(0)
                ->comment('価格');
            $table
                ->timestamps();

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products');
            $table
                ->foreign('thumb_id')
                ->references('id')
                ->on('files');
            $table
                ->foreign('thumb_target_id')
                ->references('id')
                ->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_standards');
    }
}
