<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My World</title>
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
        position: relative;
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
        position: relative;
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

    .add-post {
        position: absolute;
        top: 0px;
        right: 0px;
        float: right;
        font-size: 38px;
        margin-top: -10px;
    }

    .edit-post {
        position: absolute;
        top: 2.5px; /* 調整上邊距 */
        right: 35px; /* 調整右邊距 */
        width: 23px; /* 設置圖片寬度 */
        height: auto; /* 根據比例自動調整高度 */
        cursor: pointer;
    }

    .delete-post {
        position: absolute;
        top: 3px; /* 調整上邊距 */
        right: 5px; /* 調整右邊距 */
        width: 22px; /* 設置圖片寬度 */
        height: auto; /* 根據比例自動調整高度 */
        cursor: pointer;
    }

    .post-date {
        margin-left: 12px;
        font-size: 12px;
        color: #888888;
    }

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        max-width: 500px; /* Limit max width for better appearance */
        border-radius: 5px; /* Rounded corners */
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header, .modal-body, .modal-footer {
        padding: 10px;
    }

    .modal-header {
        border-bottom: 1px solid #eee;
    }

    .modal-footer {
        border-top: 1px solid #eee;
        text-align: right;
    }

    .modal-title {
        font-size: 22px;
        margin: 0;
    }

    .modal-body textarea {
        font-size: 16px;
        width: 100%;
        height: 150px;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #ddd;
        resize: vertical; /* Allow vertical resize */
    }

    .save-btn {
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .save-btn:hover {
        background-color: #0056b3;
    }

    .delete-btn {
        font-size: 16px;
        background-color: #dc3545; /* 紅色背景 */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #c82333; /* 懸停時的更深紅色 */
    }
</style>
<body>
    @include('includes.top_bar')

    <div class="content">
        <h2>My World <span class="add-post" style="cursor: pointer">+</span></h2>
        <div class="posts">
            @foreach ($list as $index=>$row)
                <div class="post">
                    <div class="post-author">
                        <img src="{{ asset('images/black_dog.jpg') }}" alt="Profile Photo" class="author-profile-photo">
                        {{ $row->user_name }}
                        <span class="post-date">{{ $row->updated_time }}</span>
                        <img src="{{ asset('images/edit.png') }}" alt="Edit" class="edit-post" data-modal="modal-{{ $index }}" posts-id="{{$row->id}}">
                        <img src="{{ asset('images/delete.png') }}" alt="Delete" class="delete-post" data-modal="modal-delete-{{ $index }}" posts-id="{{$row->id}}">
                    </div>
                    <div class="post-content">
                        {{ $row->content }}
                    </div>
                </div>
                <!--Edit Modal -->
                <div id="modal-{{ $index }}" class="modal" posts-id="{{$row->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2 class="modal-title">Edit Post</h2>
                        </div>
                        <div class="modal-body">
                            <textarea></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="save-btn edit-btn">Save</button>
                        </div>
                    </div>
                </div>
                <!-- Delete Modal -->
                <div id="modal-delete-{{ $index }}" class="modal" posts-id="{{$row->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2 class="modal-title">Delete Post</h2>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this post?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="delete-btn">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Create Post Modal -->
    <div id="createPostModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2 class="modal-title">Create Post</h2>
            </div>
            <div class="modal-body">
                <textarea placeholder="Feel free to say anything..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="save-btn create-btn">Create</button>
            </div>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // 打開 創建modal
        $('.add-post').on('click', function() {
            $('#createPostModal').css('display', 'block');
        });

        // 打開 編輯modal
        $('.edit-post').on('click', function() {
            var modalId = $(this).data('modal');
            var postContent = $(this).closest('.post').find('.post-content').text().trim();
            $('#' + modalId + ' textarea').val(postContent);
            $('#' + modalId).css('display', 'block');
        });

        // 打開 刪除modal
        $('.delete-post').on('click', function() {
            var modalId = $(this).data('modal');
            $('#' + modalId).css('display', 'block');
        });  

        // 關閉 modal
        $('.close').on('click', function() {
            $(this).closest('.modal').css('display', 'none');
        });

        // 點擊 modal 外的區域關閉 modal
        $(window).on('click', function(event) {
            if ($(event.target).hasClass('modal')) {
                $('.modal').css('display', 'none');
            }
        });

        // 建立貼文
        $('.save-btn.create-btn').on('click', function(){
            var content = $('#createPostModal textarea').val().trim();

            $.ajax({
                url: '/posts/create',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    content: content
                },
                success: function(response) {
                    if(response['code']=='200')
                    {
                        alert('Post create successfully');
                        window.location.href = '/my_world';
                    }
                    else
                    {
                        alert(response['message']);
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // 編輯貼文
        $('.save-btn.edit-btn').on('click', function() {
            var modal = $(this).closest('.modal');
            var postId = modal.attr('posts-id');
            var content = modal.find('textarea').val().trim();
            
            $.ajax({
                url: '/posts/update',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    post_id: postId,
                    content: content
                },
                success: function(response) {
                    alert('Post updated successfully!');
                    window.location.href = '/my_world';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // 刪除貼文
        $('.delete-btn').on('click', function() {
            var modal = $(this).closest('.modal');
            var postId = modal.attr('posts-id');
            
            $.ajax({
                url: '/posts/delete',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    post_id: postId,
                },
                success: function(response) {
                    alert('Post deleted successfully!');
                    window.location.href = '/my_world';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
</html>