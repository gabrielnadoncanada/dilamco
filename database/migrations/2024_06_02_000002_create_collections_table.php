<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('show_in_admin_menu')->default(true);
            $table->boolean('has_archive')->default(true);
            $table->foreignId('page_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('admin_menu_icon')->default('heroicon-o-rectangle-stack');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
