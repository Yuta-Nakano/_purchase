<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_relationships', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->string('relation_type')
                ->comment('関連種別: [
                    products,
                    xxx,
                ]');
            $table
                ->string('relation_id')
                ->comment('関連種別ID: [
                    relation_type.id,
                ]');
            $table
                ->unsignedBigInteger('taxonomy_id')
                ->comment('用語分類ID');
            $table
                ->timestamps();

            $table
                ->foreign('taxonomy_id')
                ->references('id')
                ->on('taxonomies');

            $table
                ->index('relation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_relationships');
    }
}
