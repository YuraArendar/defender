<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structure_id')->index();
            $table->string('alias')->unique();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('position');
            $table->enum('template', ['default']);
            $table->timestamps();
            $table->dateTime('publish_at')->nullable();
            $table->index('created_at');
            $table->index('updated_at');
            $table->index(['structure_id', 'active', 'publish_at', 'position'], 'active_content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}