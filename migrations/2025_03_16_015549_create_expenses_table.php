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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên khoản thu/chi
            $table->string('slug', 191);
            $table->integer('type')->default(1);// Phân loại thu nhập hoặc chi phí: 1=> Thu nhập, 2 => Chi phí
            $table->integer('amount')->nullable();// Số tiền
            $table->integer('member_id')->default(0);; // ID Người đưa về nguồn thu chi
            $table->unsignedBigInteger('field_id'); // Lĩnh vực 
            $table->integer('project_id')->default(0);// Dự án
            $table->text('note')->nullable(); // Ghi chú
            $table->date('date'); // Ngày ghi nhận chi phí
            $table->integer('sort')->default(9999);

            $table->nestedSet();

            $table->integer('creator_id')->default(0);
            $table->integer('updater_id')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
