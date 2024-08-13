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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // 主キーID
            $table->unsignedBigInteger('user_id'); // 外部キー: usersテーブルのID
            $table->string('title'); // スケジュールのタイトル
            $table->text('body'); // スケジュールの詳細説明
            $table->timestamp('start_time'); // スケジュールの開始時間
            $table->timestamp('end_time'); // スケジュールの終了時間
            $table->timestamps(); // created_at および updated_at カラムを自動生成
    
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
