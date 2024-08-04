<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's New</title>
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}"> <!-- 引用topbar的CSS -->
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

        .post-actions {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .like-button {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: #888888;
        }

        .like-button img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        .like-count {
            font-size: 14px;
            color: #333333;
        }
    </style>
</head>
<body>
    @include('includes.top_bar')

    <div class="content">
        <h2>What's New!</h2>
        <div class="posts">
            @foreach ($list as $index=>$row)
                <div class="post" data-post-id="{{ $row['id'] }}">
                    <div class="post-author">
                        <img src="{{ asset('images/black_dog.jpg') }}" alt="Profile Photo" class="author-profile-photo">
                        {{ $row['user_name'] }}
                        <span class="post-date">{{ $row['updated_time']}}</span>
                    </div>
                    <div class="post-content">
                        {{ $row['content'] }}
                    </div>
                    <div class="post-actions">
                        <button class="like-button {{ $row['is_like'] ? 'liked' : '' }}" onclick="toggleLike(this)">
                            @if($row['is_like'])
                                <img src="{{ asset('images/heart_filled.png') }}" alt="Like" class="like-icon">
                            @else
                                <img src="{{ asset('images/heart_outline.png') }}" alt="Like" class="like-icon">
                            @endif
                        </button>
                        <span class="like-count">{{ $row['like_count'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleLike(button) {
            const post = button.closest('.post');
            const postId = post.getAttribute('data-post-id');
            const likeIcon = button.querySelector('.like-icon');
            const likeCountElement = post.querySelector('.like-count');
            let likeCount = parseInt(likeCountElement.textContent);

            if (button.classList.contains('liked')) {
                // Unlike
                likeIcon.src = "{{ asset('images/heart_outline.png') }}";
                likeCount -= 1;
                button.classList.remove('liked');

                $.ajax({
                    url: '/like/delete',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        post_id: postId
                    },
                    success: function(response) {
                        //
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            else
            {
                // Like
                likeIcon.src = "{{ asset('images/heart_filled.png') }}";
                likeCount += 1;
                button.classList.add('liked');

                $.ajax({
                    url: '/like/create',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        post_id: postId
                    },
                    success: function(response) {
                        //pass
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            likeCountElement.textContent = likeCount;
        }
    </script>
</body>
</html>
