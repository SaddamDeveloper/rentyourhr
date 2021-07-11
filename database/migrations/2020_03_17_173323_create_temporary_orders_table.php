<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_profile_id');
            $table->unsignedBigInteger('package_id');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->decimal('min_salary', 8, 2)->nullable();
            $table->decimal('max_salary', 8, 2)->nullable();
            $table->decimal('amount', 8, 2);
            $table->text('experience')->nullable();
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('state', 60);
            $table->string('city', 60);
            $table->string('zip', 20);
            $table->string('gst_number');
            $table->decimal('cgst', 8, 2);
            $table->decimal('sgst', 8, 2);
            $table->decimal('igst', 8, 2);
            $table->decimal('total', 8, 2);
            $table->boolean('status')->default(1);
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('temporary_orders');
    }
}
