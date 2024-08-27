// import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";

// idがcalendarのDOMを取得
var calendarEl = document.getElementById("calendar");

// カレンダーの設定
let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin],

    // 最初に表示させる形式
    initialView: "dayGridMonth",

    // ヘッダーの設定（左/中央/右）
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
});

// レンダリング
calendar.render();