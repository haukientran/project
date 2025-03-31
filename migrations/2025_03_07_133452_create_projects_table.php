<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug', 191);
            $table->string('image', 191)->nullable();
            $table->text('description')->nullable();

            $table->string('manager_id'); // Người phụ trách (liên kết admin_users)
            $table->string('member_ids'); // Người tham gia dự án (liên kết admin_users)
            $table->unsignedBigInteger('field_id'); // Lĩnh vực
            $table->integer('total_revenue')->nullable();// Tổng thu
            $table->integer('total_expense')->nullable();// Tổng chi
            $table->timestamp('renewed_at')->nullable(); // Thời gian gia hạn
            $table->date('deadline'); // Deadline
            $table->integer('sort')->default(9999);

            $table->nestedSet();

            $table->integer('creator_id')->default(0);
            $table->integer('updater_id')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
