<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id')->unique();
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
        Schema::dropIfExists('content_meta');
    }
}
