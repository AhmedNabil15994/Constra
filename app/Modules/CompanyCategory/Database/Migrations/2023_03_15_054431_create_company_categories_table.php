<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('company_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar')->required();
            $table->string('name_en')->required();
            $table->string('image')->nullable();
            $table->integer('parent_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_categories');
    }
}
