<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationAddActivityFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threads', function (Blueprint $table)
        {
            $table->string('thread_location', 255);
            $table->string('title', 255);
            $table->text('settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('threads', function (Blueprint $table)
        {
            $table->dropColumn('thread_location');
            $table->dropColumn('title');
            $table->dropColumn('settings');
        });
    }
}
