<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_name')->unique();
            $table->decimal('salary', 8, 2)->nullable();
            $table->text('must_have')->nullable();
            $table->text('good_to_have')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('job_profiles');
    }
}
