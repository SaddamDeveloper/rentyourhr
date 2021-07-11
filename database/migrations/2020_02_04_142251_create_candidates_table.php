<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->dropIfExists('candidates');
        Schema::connection('mysql')->create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 90);
            $table->string('email', 90)->unique();
            $table->string('mobile', 16)->unique()->nullable();
            $table->string('user_code', 100)->unique();
            $table->string('industry', 100)->nullable();
            $table->string('job_position', 100)->nullable();
            $table->string('experience', 10)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('pan_no', 50)->nullable();
            $table->string('aadhar_no', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('zip', 50)->nullable();
            $table->string('current_company', 150)->nullable();
            $table->string('current_job_position', 150)->nullable();
            $table->string('current_salary', 150)->nullable();
            $table->string('expected_salary', 150)->nullable();
            $table->string('expected_location', 150)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status', 10)->nullable();
            $table->string('passport', 10)->nullable();
            $table->string('cv_file')->nullable();
            $table->string('cv_file_client')->nullable();
            $table->text('skills')->nullable();
            $table->string('status')->nullable();
            $table->string('parent_code', 100)->nullable();
            $table->date('attached_on')->nullable();
            $table->string('parent_email', 100)->nullable();
            $table->string('parent_name', 100)->nullable();
            $table->string('parent_mobile', 100)->nullable();
            $table->string('webite_last_update', 100)->nullable();
            $table->boolean('is_delete')->default(0);
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
        Schema::connection('mysql')->dropIfExists('candidates');
    }
}
