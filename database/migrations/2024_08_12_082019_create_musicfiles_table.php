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
        Schema::create('musicfiles', function (Blueprint $table) {
            $table->id(); // 主キーID
            $table->unsignedBigInteger('user_id'); // 外部キー: usersテーブルのID
            $table->string('title'); // タイトル
            $table->string('body'); // 音楽ファイルの詳細説明
            $table->string('image_url');// ファイルパス
            $table->softDeletes();//削除日
            $table->timestamps(); // 更新日と作成日
    
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musicfiles');
    }
};
