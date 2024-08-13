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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // 主キーID
            $table->unsignedBigInteger('sender_id'); // 送った人のID
            $table->unsignedBigInteger('receiver_id'); // 受け取った人のID
            $table->unsignedBigInteger('chat_id'); // チャットのID
            $table->text('message'); // メッセージ本文
            $table->timestamp('sent_at'); // 送った時間
            //unsignedBigIntegerは符号なしの64bitの整数であることを表す
    
            // 外部キー制約
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            //$table->foreign('chat_id')->references('id')->on('chats') chatsテーブルのidと関連づけている
            //onDelete->親テーブルが削除されると外部キーも削除される
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
