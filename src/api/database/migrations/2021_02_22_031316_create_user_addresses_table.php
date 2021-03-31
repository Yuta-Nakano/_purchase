<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->unsignedBigInteger('user_id')
                ->comment('ユーザーID');
            $table
                ->string('dist_name')
                ->comment('お届け先名');
            $table
                ->string('last_name')
                ->comment('姓');
            $table
                ->string('fast_name')
                ->comment('名');
            $table
                ->string('post_code')
                ->comment('郵便番号');
            $table
                ->string('prefecture')
                ->comment('都道府県');
            $table
                ->string('municipality')
                ->comment('市区町村');
            $table
                ->string('block_number')
                ->nullable()
                ->comment('番地');
            $table
                ->string('building')
                ->nullable()
                ->comment('建物・部屋番号');
            $table
                ->string('phone_number')
                ->comment('電話番号');
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
        Schema::dropIfExists('user_addresses');
    }
}
