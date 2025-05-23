<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar')->required();
          $table->string('name_en')->required();
          $table->longText('description_ar')->nullable();
          $table->longText('description_en')->nullable();
          $table->integer('category_id')->nullable();
          $table->integer('status')->default(0);
          $table->string('image')->nullable();
          $table->integer('views')->default(0);
          $table->integer('rate')->default(0);
          $table->text('location')->nullable();
          $table->string('phone')->required();
          $table->string('email')->nullable();
          $table->string('website')->nullable();
          $table->string('whatsapp')->nullable();
          $table->string('facebook')->nullable();
          $table->string('twitter')->nullable();
          $table->string('linkedin')->nullable();
          $table->string('instagram')->nullable();
          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
