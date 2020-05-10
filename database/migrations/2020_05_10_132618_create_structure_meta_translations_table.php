<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureMetaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_meta_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structure_meta_id')->index();
            $table->string('locale', 2)->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unique(['structure_meta_id','locale']);
            $table->foreign('structure_meta_id')
                ->references('id')
                ->on('structure_meta')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('structure_meta_translations');
    }
}
