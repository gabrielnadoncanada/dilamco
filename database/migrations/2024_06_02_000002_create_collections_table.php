<?php

use App\Enums\PermalinkType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('permalink_type')->default(PermalinkType::KEY);
            $table->boolean('show_in_admin_menu')->default(true);
            $table->boolean('has_archive')->default(true);
            $table->foreignId('single_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('admin_menu_icon')->default('heroicon-o-rectangle-stack');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
