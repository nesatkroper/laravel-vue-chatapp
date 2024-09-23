<?php

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
        Schema::create('table_lists', function (Blueprint $table) {
            $table->id("tb_id");
            $table->integer('member_id_1');
            $table->integer('member_id_2');
            $table->string('table_name')->nullable();
            $table->string('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_delete', ['true', 'false'])->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_lists');
    }
};