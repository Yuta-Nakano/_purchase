<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->string('name')
                ->comment('ユーザー名');
            $table
                ->string('password')
                ->comment('パスワード');
            $table
                ->string('email')
                ->unique()
                ->comment('Eメール');
            $table
                ->timestamp('email_verified_at')
                ->nullable()
                ->comment('メール認証時間');
            $table
                ->date('birthday')
                ->nullable()
                ->comment('生年月日');
            $table
                ->string('sex')
                ->nullable()
                ->comment('性別');
            $table
                ->unsignedBigInteger('billing_address_id')
                ->nullable()
                ->comment('請求先住所ID');
            $table
                ->rememberToken()
                ->comment('トークン記録');
            $table
                ->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
