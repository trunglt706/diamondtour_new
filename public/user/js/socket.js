// Websocket
let conn = new WebSocket(`${WsUrl}:${WsPort}`);
if (conn) {
    conn.onopen = function (e) {
        // Connect to websocket
        conn.send(
            JSON.stringify({
                command: "register",
                userId: userId,
            })
        );
    };

    conn.onerror = function (e) {
        // Error handling
    };

    conn.onclose = function (e) {};

    conn.onmessage = function (e) {
        let json = JSON.parse(e.data);
        const { title, icon, domain, notify, staffId } = json.data;
        if (domain && domain == WsHost) {
            const { content, link, staff_id } = notify;
            switch (json.command) {
                case "send_notify":
                    if (staff_id == userId) {
                        notifyDesktop(title, content, link, icon);
                        // prepend notify and add count notify total
                        let notify_total = $(
                            ".notification .notify-total"
                        ).text();
                        notify_total = Number(notify_total) + 1;
                        let notify_content = $(".notification .content").html();
                        const new_notify = `<a href="${link}" onclick="" class="dropdown-notification-item notification-item read-0 item-${
                            notify?.id
                        }" data-id="${notify?.id}" data-status="0">
                                                <div class="dropdown-notification-icon">
                                                    <i class="far fa-dot-circle"></i>
                                                </div>
                                                <div class="dropdown-notification-info">
                                                    <div class="title">
                                                        ${content}
                                                    </div>
                                                    <div class="time">
                                                        ${timeConverter(
                                                            notify?.created_at
                                                        )}
                                                    </div>
                                                </div>
                                                <div class="dropdown-notification-arrow">
                                                    <i class="fa fa-chevron-right"></i>
                                                </div>
                                            </a>`;
                        notify_content = new_notify + notify_content;
                        $(".notification .content").html(notify_content);
                        $(".notification .notify-total").text(notify_total);
                    }
                    break;
                case "send_test":
                    if (staff_id == userId) {
                        notifyDesktop(title, content, link, icon);
                    }
                    break;
                case "send_block_account":
                    if (staffId == userId) {
                        // logout account
                        location.href = urlLogout;
                    }
                    break;
            }
        }
    };
}
