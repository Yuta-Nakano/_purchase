<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->text('name')
                ->comment('名前');
            $table
                ->string('slug')
                ->unique()
                ->comment('スラッグ');
            $table
                ->longText('content')
                ->nullable()
                ->comment('本文');
            $table
                ->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
