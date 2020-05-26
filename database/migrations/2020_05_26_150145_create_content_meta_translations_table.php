<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentMetaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_meta_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_meta_id')->index();
            $table->string('locale', 2)->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unique(['content_meta_id','locale']);
            $table->foreign('content_meta_id')
                ->references('id')
                ->on('content_meta')
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
        Schema::dropIfExists('content_meta_translations');
    }
}
