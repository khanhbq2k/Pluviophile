$(document).ready(function() {
    var path = 'localhost:80/Pluviophile';

    var postId = $('#post-id').attr('value');

    listAllComments(path);

    setInterval(function() {
        listAllComments(path);
    }, 10000);

    $('#comment-form').on('submit', function(e) {
        e.preventDefault();
        var commentContent = String($('#comment-content').val()).trim();
        var userId = $('#user-id').attr('value');
        if (!userId) {
            let message = document.getElementsByClassName('message')[0];
            message.innerHTML = `
                            <div id="msg" class="error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <ul>
                                    <li>You have to login to post a comment</li>
                                </ul>
                                <i class="ti-close"></i>
                            </div>`;
            var msg = document.getElementById("msg");
            msg.classList.add("show");
            setTimeout(function() { msg.className = msg.className.replace("show", ""); }, 4000);
            $('#msg .ti-close').click(function() {
                $('#msg').removeClass('show');
            })
            return;
        }
        if (commentContent) {
            $.ajax({
                url: `http://${path}/app/helpers/processComment.php`,
                data: {
                    content: commentContent,
                    post_id: postId,
                    user_id: userId
                },
                type: 'POST',
                success: function(res) {
                    if (res) {
                        let message = document.getElementsByClassName('message')[0];
                        message.innerHTML = `
                            <div id="msg" class="error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <ul>
                                    <li>${res.replace(/(['[\]"]+)/g, '')}</li>
                                </ul>
                                <i class="ti-close"></i>
                            </div>`;
                        var msg = document.getElementById("msg");
                        msg.classList.add("show");
                        setTimeout(function() { msg.className = msg.className.replace("show", ""); }, 4000);
                        $('#msg .ti-close').click(function() {
                            $('#msg').removeClass('show');
                        })
                    } else {
                        listAllComments(path);
                    }
                }
            })
        }
        $('#comment-content').val('');
    });

    /**
     * List all the comments of a post just got from database 
     */
    function listAllComments(path) {
        $.ajax({
            url: `http://${path}/app/helpers/getAllComments.php`,
            data: {
                post_id: postId
            },
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $('.all-comment').empty();
                //Display comments
                for (var i = 0; i < res.length; ++i) {
                    let date = new Date(res[i].created_at);
                    let month = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
                        "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
                    ][date.getMonth()];
                    let formattedDate = date.getHours() + ':' + date.getMinutes() + '&nbsp;&nbsp;&nbsp;' + month + ' ' + date.getDate() + ' ' + date.getFullYear();

                    let comment = document.createElement('div');
                    comment.className = 'comment';
                    comment.innerHTML = `
                        <div class="comment-meta">
                            <div class="comment-username">
                                ${res[i].fullname}
                            </div>
                            <div class="comment-at">
                                ${formattedDate}
                            </div>
                        </div>
                        <div class="comment-content">
                            ${res[i].content}
                        </div>`

                    $('.all-comment').append(comment);
                }
            }
        })
    }


})