<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('description');
            $table->string('category');
            $table->string('accredited_by');
            $table->longText('aims')->nullable();
            $table->string('objectives_header')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('target_audience')->nullable();
            $table->string('delegate_prerequisite')->nullable();
            $table->integer('duration');
            $table->integer('validity')->nullable();
            $table->integer('branch_id');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
