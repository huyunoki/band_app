<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function store(Request $request)
    {
        Log::info('これは情報ログです');
        $event = new Event;
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $event->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $event->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $event->name = $request->input('name');
        $event->user_id = auth()->id();
        $event->save();

    }
    
    public function getEvent(Request $request)
    {
        // カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
    
        // 登録処理
        return Event::query()
            ->select(
                // FullCalendarの形式に合わせる
                'start_date as start',
                'end_date as end',
                'name as title',
                'id'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->where('user_id', auth()->id())
            ->get();
    }
    
    public function update(Request $request, Event $event)
    {
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $event->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $event->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $event->user_id = auth()->id();
        $event->save();
    }
    
    // public function edit(Request $request, $id)
    // {
    //     $event = Event::find($id);
    //     if ($event) {
    //         $event->name = $request->input('name');
    //         $event->save();
    //         return response()->json(['success' => true]);
    //     }
    //     return response()->json(['success' => false], 404);
    // }
    
    public function delete(Request $request, Event $event)
    {
        $event->delete();
    }
}