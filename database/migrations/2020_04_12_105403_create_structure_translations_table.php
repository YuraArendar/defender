<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structure_id')->index();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('content')->nullable();

            $table->unique(['structure_id','locale']);
            $table->foreign('structure_id')
                ->references('id')
                ->on('structures')
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
        Schema::dropIfExists('structure_translations');
    }
}
