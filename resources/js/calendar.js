// import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import axios from 'axios'; 
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction"; 

// idがcalendarのDOMを取得
var calendarEl = document.getElementById("calendar");

let click = 0;
let oneClickTimer;

// カレンダーの設定
let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin],

    // 最初に表示させる形式
    initialView: "dayGridMonth",

    // ヘッダーの設定（左/中央/右）
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
    
    editable: true,
    eventClick: function(info) {
        click++;
        if (click === 1) {
            // 略
        } else if (click === 2) {
            clearTimeout(oneClickTimer);  // クリック1回時の処理を削除
            click = 0;

            // 削除処理
            if(!confirm('イベントを削除しますか？')) return false;

            const id = info.event._def.publicId;
            axios
                .post(`/calendar/${id}/delete`)
                .then(() => {
                    info.event.remove();  // カレンダーからイベントを削除
                    // alert("削除に成功しました！");
                })
                .catch(() => {
                    alert("削除に失敗しました");
                });
        }
    },
    
    selectable: true,  // 複数日選択可能
    select: function (info) {  // 選択時の処理
        // console.log(info)
        const eventName = prompt("イベントを入力してください");
        // 入力された時に実行される
        if (eventName) {
            // 開始日を一日進める
            axios.post("/calendar/store", {
                start_date: (info.start.valueOf()),
                end_date: info.end.valueOf(),
                name: eventName,
            })
                .then(response => {
                    // イベントの追加
                    calendar.addEvent({
                        id: response.data.id,
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: true,
                    });
                })
                .catch(() => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました");
                });
        }
    },
    events: function (info, successCallback, failureCallback) {
        axios
            .post("/calendar/event", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then(response => {
                // 追加したイベントを削除
                calendar.removeAllEvents();
                // カレンダーに読み込み
                successCallback(response.data);
            })
            .catch(() => {
                // バリデーションエラーなど
                alert("取得に失敗しました");
            });
    },
    eventDrop: function(info) {
        const id = info.event._def.publicId; // イベントのDBに登録されているidを取得
        console.log(id);
        axios
            .post(`/calendar/${id}`, {
                start_date: info.event._instance.range.start.valueOf(),
                end_date: info.event._instance.range.end.valueOf(),
            })
            .then(() => {
                alert("登録に成功しました！");
            })
            .catch(() => {
                // バリデーションエラーなど
                alert("登録に失敗しました");
            });
    },
});

// レンダリング
calendar.render();