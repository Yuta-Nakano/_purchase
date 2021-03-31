<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->string('name')
                ->comment('用語分類: [
                    category,
                    tag
                ]');
            $table
                ->unsignedBigInteger('term_id')
                ->comment('用語ID');
            $table
                ->unsignedBigInteger('parent_id')
                ->nullable()
                ->comment('親用語ID');
            $table
                ->timestamps();

            $table
                ->foreign('term_id')
                ->references('id')
                ->on('terms');
            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
}
