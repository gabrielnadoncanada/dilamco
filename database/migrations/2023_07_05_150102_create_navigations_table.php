<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('handle')->unique();
            $table->longText('items')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
