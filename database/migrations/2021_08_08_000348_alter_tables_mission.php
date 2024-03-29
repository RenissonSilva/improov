<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesMission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->char('ativo')->default("S")->nullable();
            $table->dropColumn('is_active');
        });
        Schema::table('mission_user', function (Blueprint $table) {
            $table->char('ativo')->nullable();
            $table->char('is_active')->default("S");
        });
       }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
