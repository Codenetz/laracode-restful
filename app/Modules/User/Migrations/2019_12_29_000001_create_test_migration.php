<?php

use Illuminate\Database\Migrations\Migration;

class CreateTestMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo 'UP';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo 'DOWN';
    }
}
