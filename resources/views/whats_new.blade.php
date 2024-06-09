<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's New</title>
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}"> <!-- 引用topbar的CSS -->
</head>
<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .content {
        max-width: 800px;
        margin: 20px auto;
        padding: 0 20px;
    }

    .posts {
        margin-top: 20px;
    }

    .post {
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .post-author {
        font-size: 14px;
        color: #333333;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .author-profile-photo {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .post-content {
        font-size: 16px;
        color: #333333;
    }

    .post-date {
        margin-left: 12px;
        font-size: 12px;
        color: #888888;
    }
</style>
<body>
    @include('includes.top_bar')

    <div class="content">
        <h2>What's New!</h2>
        <div class="posts">
            @foreach ($list as $index=>$row)
                <div class="post">
                    <div class="post-author">
                        <img src="{{ asset('images/black_dog.jpg') }}" alt="Profile Photo" class="author-profile-photo">
                        {{ $row->user_name }}
                        <span class="post-date">{{ $row->updated_time}}</span>
                    </div>
                    <div class="post-content">
                        {{ $row->content }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>