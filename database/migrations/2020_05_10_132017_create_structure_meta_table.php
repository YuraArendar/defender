<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structure_id')->unique();
            $table->boolean('index')->default(false);
            $table->boolean('noindex')->default(false);
            $table->boolean('follow')->default(false);
            $table->boolean('nofollow')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('structure_meta');
    }
}
