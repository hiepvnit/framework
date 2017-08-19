<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mage2AttributeSchemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('attributes');
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['PRODUCT','ORDER','CUSTOMER','CATEGORY'])->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('identifier')->nullable()->default(null);
            $table->enum('field_type',['SELECT'])->nullable()->default(null);
            $table->enum('use_as',['VARIATION','SPECIFICATION'])->nullable()->default(null);
            $table->integer('sort_order')->defaul(0);
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
        Schema::dropIfExists('attributes');
    }
}
