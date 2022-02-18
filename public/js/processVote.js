$(document).ready(function() {
    var path = 'localhost:80/Pluviophile';

    var postId = $('#post-id').attr('value');

    updateVotes(path);

    setInterval(function() {
        updateVotes(path);
    }, 10000);

    $('.up-vote').on('click', function() {
        var userId = $('#user-id').attr('value');
        if (!userId) {
            let message = document.getElementsByClassName('message')[0];
            message.innerHTML = `
                            <div id="msg" class="error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <ul>
                                    <li>You have to login to upvote</li>
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

        $.ajax({
            url: `http://${path}/app/helpers/processUpVote.php`,
            data: {
                post_id: postId,
                user_id: userId
            },
            type: 'POST',
            success: function(res) {
                updateVotes(path);
            }
        })

    })

    $('.down-vote').on('click', function() {
        var userId = $('#user-id').attr('value');
        if (!userId) {
            let message = document.getElementsByClassName('message')[0];
            message.innerHTML = `
                            <div id="msg" class="error">
                                <i class="fas fa-exclamation-triangle"></i>
                                <ul>
                                    <li>You have to login to downvote</li>
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

        $.ajax({
            url: `http://${path}/app/helpers/processDownVote.php`,
            data: {
                post_id: postId,
                user_id: userId
            },
            type: 'POST',
            success: function(res) {
                updateVotes(path);
            }
        })

    })

    /**
     * Make a ajax request to update votes of a post
     */
    function updateVotes(path) {
        $.ajax({
            url: `http://${path}/app/helpers/updateVotes.php`,
            data: {
                post_id: postId
            },
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                var vote = document.getElementById('vote');
                vote.innerHTML = res.upvotes;
            }
        })
    }

})