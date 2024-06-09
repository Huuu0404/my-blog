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
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; /* 使用類似 macOS 的字體 */
    }

    .menu-items {
        display: flex;
    }

    .menu-item {
        margin-left: 20px;
        margin-right: 30px;
        font-size: 20px;
        color: #333333;
        text-decoration: none;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; /* 使用類似 macOS 的字體 */
    }

    .menu-item:hover {
        text-decoration: none;
    }
</style>


<div class="topbar-container">
    <div class="user-info">
        <img src="{{ asset('images/black_dog.jpg') }}" alt="Profile Photo" class="profile-photo">
        <span class="user-name">{{ session('user_name') }}</span>
    </div>
    <div class="menu-items">
        <a href="/whats_new" class="menu-item">What’s new!</a>
        <a href="/my_world" class="menu-item">My world</a>
        <a href="/logout" class="menu-item">Logout</a>
    </div>
</div>
