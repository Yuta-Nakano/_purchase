<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->string('slug')
                ->unique()
                ->comment('スラッグ名');
            $table
                ->string('name')
                ->comment('タイトル');
            $table
                ->string('filename')
                ->unique()
                ->comment('ファイル名');
            $table
                ->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
}
