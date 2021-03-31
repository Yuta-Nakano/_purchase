<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attachments', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->unsignedBigInteger('product_id')
                ->comment('コンテンツID');
            $table
                ->unsignedBigInteger('file_id')
                ->comment('ファイルID');

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products');
            $table
                ->foreign('file_id')
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
        Schema::dropIfExists('attachments');
    }
}
