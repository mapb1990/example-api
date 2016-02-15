<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRehabilitationsTable
 *
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class CreateRehabilitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rehabilitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('professional_id');
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->boolean('reminder')->default(false);
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');
            $table->foreign('professional_id')
                ->references('id')
                ->on('professionals')
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
        Schema::drop('rehabilitations');
    }
}
