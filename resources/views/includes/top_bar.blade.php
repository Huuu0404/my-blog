<style>
    .topbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #f5f5f5;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .profile-photo {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-name {
        font-size: 22px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .menu-items {
        display: flex;
        align-items: center;
    }

    .menu-item {
        margin-left: 20px;
        margin-right: 30px;
        font-size: 20px;
        color: #333333;
        text-decoration: none;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .menu-item:hover {
        text-decoration: none;
    }

    .notification-icon {
        position: relative;
        cursor: pointer;
    }

    .notification-icon img {
        width: 24px;
        height: 24px;
    }

    .notification-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }

    .notification-list {
        display: none;
        position: absolute;
        top: 55px; /* 調整位置到圖標下方 */
        right: 140px;
        background-color: white;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        width: 300px;
        z-index: 1000;
    }

    .notification-list.active {
        display: block;
    }

    .notification-item {
        padding: 10px;
        border-bottom: 1px solid #f5f5f5;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item.unread {
        background-color: #f0f0f0;
    }

    .notification-content {
        font-size: 14px;
        color: #333333;
    }

    .notification-time {
        font-size: 12px;
        color: #888888;
    }
</style>

<div class="topbar-container">
    <div class="user-info">
        <img src="{{ asset('images/black_dog.jpg') }}" alt="Profile Photo" class="profile-photo">
        <span class="user-name">{{ session('user_name') }}</span>
    </div>
    <div class="menu-items">
        <div class="notification-icon" onclick="toggleNotifications()">
            <img src="{{ asset('images/notification.png') }}" alt="Notifications">
            @if($unread_counts > 0)
                <span class="notification-count">{{ $unread_counts }}</span>
            @endif
        </div>
        <div class="notification-list">
            @foreach($notification as $row)
                <div class="notification-item {{ $row['is_read'] == 0 ? 'unread' : '' }}" data-id="{{ $row['id'] }}">
                    <div class="notification-content">{{ $row['content'] }}</div>
                    <div class="notification-time">{{ \Carbon\Carbon::parse($row['created_at'])->format('Y-m-d H:i:s') }}</div>
                </div>
            @endforeach
        </div>        
        <a href="/whats_new" class="menu-item">What’s new!</a>
        <a href="/my_world" class="menu-item">My world</a>
        <a href="/logout" class="menu-item">Logout</a>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    function toggleNotifications() {
        const notificationList = $('.notification-list');
        notificationList.toggleClass('active');
        
        if (!notificationList.hasClass('active')) {
            const unreadNotificationIds = [];
            $('.notification-item.unread').each(function() {
                unreadNotificationIds.push($(this).data('id'));
            });

            if(unreadNotificationIds.length > 0)
            {
                $.ajax({
                    url: '/readNotification',
                    method: 'POST',
                    data: {
                        notification_ids: unreadNotificationIds,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $('.notification-count').text(0).hide();
            $('.notification-item.unread').removeClass('unread');
        }
    }

    function getNotification() {
        $.ajax({
            url: '/getNotification',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('.notification-list').empty();
                let unreadCount = 0;

                response.forEach(notification => {
                    const itemClass = notification.is_read ? '' : 'unread';
                    const date = new Date(notification.created_at);
                    const formattedDate = date.getFullYear() + '-' +
                                        String(date.getMonth() + 1).padStart(2, '0') + '-' +
                                        String(date.getDate()).padStart(2, '0') + ' ' +
                                        String(date.getHours()).padStart(2, '0') + ':' +
                                        String(date.getMinutes()).padStart(2, '0') + ':' +
                                        String(date.getSeconds()).padStart(2, '0');

                    $('.notification-list').append(`
                        <div class="notification-item ${itemClass}" data-id="${notification.id}">
                            <div class="notification-content">${notification.content}</div>
                            <div class="notification-time">${formattedDate}</div>
                        </div>
                    `);

                    if (!notification.is_read) {
                        unreadCount++;
                    }
                });

                if (unreadCount > 0) {
                    $('.notification-count').text(unreadCount).show();
                } else {
                    $('.notification-count').text(0).hide();
                }
                console.log("unreadCount : ", unreadCount);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Initialize Pusher
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data);
        getNotification();
    });

    // $(document).ready(function() {
    //     setInterval(getNotification, 1000);
    // });
</script>
