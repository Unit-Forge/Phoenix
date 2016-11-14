<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('details')->nullable();
            $table->string('link')->nullable();
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('award_file', function (Blueprint $table) {
            $table->unsignedInteger('award_id');
            $table->unsignedInteger('file_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('award_file');
        Schema::dropIfExists('awards');
    }
}
