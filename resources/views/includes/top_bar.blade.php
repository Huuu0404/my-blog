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
            <span class="notification-count">3</span> <!-- Example count -->
        </div>
        <div class="notification-list">
            <div class="notification-item unread">
                <div class="notification-content">New comment on your post</div>
                <div class="notification-time">2 minutes ago</div>
            </div>
            <div class="notification-item unread">
                <div class="notification-content">You have a new follower</div>
                <div class="notification-time">10 minutes ago</div>
            </div>
            <div class="notification-item unread">
                <div class="notification-content">New like on your post</div>
                <div class="notification-time">30 minutes ago</div>
            </div>
        </div>
        <a href="/whats_new" class="menu-item">What’s new!</a>
        <a href="/my_world" class="menu-item">My world</a>
        <a href="/logout" class="menu-item">Logout</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleNotifications() {
        const notificationList = $('.notification-list');
        notificationList.toggleClass('active');
        
        if (!notificationList.hasClass('active')) {
            // 清除通知計數並隱藏
            $('.notification-count').text(0).hide();
            
            // 移除所有通知項的未讀狀態
            $('.notification-item.unread').removeClass('unread');
        }
    }

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.notification-icon').length && !$(event.target).closest('.notification-list').length) {
            const notificationList = $('.notification-list');
            if (notificationList.hasClass('active')) {
                notificationList.removeClass('active');

                // 清除通知計數並隱藏
                $('.notification-count').text(0).hide();
                
                // 移除所有通知項的未讀狀態
                $('.notification-item.unread').removeClass('unread');
            }
        }
    });
</script>
