$(document).ready(function () {
    function fetchData(type, target) {
        $.ajax({
            url: "fetch_data.php",
            type: "POST",
            data: { type: type },
            dataType: "json",
            success: function (data) {
                $(target).text(data.count);
            },
            error: function () {
                $(target).text("Error");
            }
        });
    }

    fetchData("inventory", "#inventory-count");
    fetchData("news_events", "#news-count");
    fetchData("users", "#user-count");

    function loadLendingItems() {
        $.ajax({
            url: "fetch_lending.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let lendingHTML = "";
                data.forEach(item => {
                    lendingHTML += `
                        <div class="lending-item">
                            <h4>${item.item_name}</h4>
                            <p>Borrowed: ${item.borrow_day}</p>
                            <p>Return: ${item.return_day}</p>
                        </div>
                    `;
                });
                $("#lending-data").html(lendingHTML);
            },
            error: function () {
                $("#lending-data").html("<p>Error loading data</p>");
            }
        });
    }

    loadLendingItems();

    function loadTrackingRecords() {
        $.ajax({
            url: "fetch_tracking.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let trackingHTML = "";
                data.forEach(item => {
                    let statusColor = item.status === "Overdue" ? "red" : 
                                      item.status === "In Use" ? "orange" : "green";
                    trackingHTML += `
                        <div class="tracking-item">
                            <h4>${item.item_name}</h4>
                            <p>Borrowed: ${item.borrow_day}</p>
                            <p>Return: ${item.return_day}</p>
                            <p style="color: ${statusColor}; font-weight: bold;">${item.status}</p>
                        </div>
                    `;
                });
                $("#tracking-data").html(trackingHTML);
            },
            error: function () {
                $("#tracking-data").html("<p>Error loading data</p>");
            }
        });
    }

    loadTrackingRecords();

function loadMessages() {
    $.ajax({
        url: "fetch_messages.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            let messageHTML = "";
            data.forEach(msg => {
                messageHTML += `
                    <div class="message-item">
                        <h4>${msg.client_name}</h4>
                        <p class="email">${msg.email}</p>
                        <p>${msg.message}</p>
                        <p style="font-size: 12px; color: lightgray;">${msg.request_time}</p>
                    </div>
                `;
            });
            $("#message-data").html(messageHTML);
        },
        error: function () {
            $("#message-data").html("<p>Error loading messages</p>");
        }
    });
}

loadMessages();
});