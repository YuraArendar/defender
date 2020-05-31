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
            $table->unsignedBigInteger('position')->default(0);
            $table->enum('template', ['default']);
            $table->timestamps();
            $table->dateTime('publish_at')->nullable();
            $table->index('created_at');
            $table->index('updated_at');
            $table->index(['structure_id', 'active', 'publish_at', 'position'], 'active_content');
            $table->index(['structure_id', 'active', 'publish_at', 'created_at'], 'content_by_created_date');
            $table->index(['structure_id', 'active', 'publish_at', 'updated_at'], 'content_by_updated_date');
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
