<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->text('address')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('phone', 10)->nullable();
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
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
        });
    }
}
