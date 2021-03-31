<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payments', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->unsignedBigInteger('user_id')
                ->comment('ユーザーID');
            $table
                ->string('payment_type')
                ->comment('決済種別');
            $table
                ->string('credit_card_type')
                ->nullable()
                ->comment('カード種別');
            $table
                ->string('credit_card_numbar')
                ->nullable()
                ->comment('カード番号');
            $table
                ->string('credit_expiration_date')
                ->nullable()
                ->comment('カード有効期限');
            $table
                ->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payments');
    }
}
