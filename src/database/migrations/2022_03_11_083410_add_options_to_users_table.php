<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->integer('phone')->nullable()->after('email');
             $table->string('telegram_username')->nullable()->after('email');
             $table->enum('status', ['ban', 'active', 'unverified'])->default('unverified')->after('email');
             $table->enum('account', ['free', 'paid', 'unlimit'])->default('free')->after('email');
             $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('account');
            $table->dropColumn('phone');
            $table->dropColumn('telegram_username');
        });
    }
}
