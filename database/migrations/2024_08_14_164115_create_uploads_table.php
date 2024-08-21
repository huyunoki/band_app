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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id(); // 主キーID
            $table->string('title')->nullable(); // タイトル
            $table->string('description')->nullable(); // 音楽ファイルの詳細説明
            $table->string('image_url')->nullable();// ファイルパス
            $table->softDeletes();//削除日
            $table->timestamps(); // 更新日と作成日
    
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
