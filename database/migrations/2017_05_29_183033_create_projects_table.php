<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->string('code');
            $table->string('name');
            $table->integer('acct_manager')->unsigned();
            $table->string('trend')->nullable();
            $table->integer('req_status')->unsigned()->nullable();
            $table->dateTime('req_eta')->nullable();
            $table->integer('dev_status')->unsigned()->nullable();
            $table->dateTime('dev_eta')->nullable();
            $table->integer('qa_status')->unsigned()->nullable();
            $table->dateTime('qa_eta')->nullable();
            $table->integer('uat_status')->unsigned()->nullable();
            $table->dateTime('uat_eta')->nullable();
            $table->integer('prod_status')->unsigned()->nullable();
            $table->dateTime('prod_eta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('acct_manager')->references('id')->on('users');
            $table->foreign('req_status')->references('id')->on('project_status');
            $table->foreign('dev_status')->references('id')->on('project_status');
            $table->foreign('qa_status')->references('id')->on('project_status');
            $table->foreign('uat_status')->references('id')->on('project_status');
            $table->foreign('prod_status')->references('id')->on('project_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('projects');
        Schema::enableForeignKeyConstraints();
    }
}
