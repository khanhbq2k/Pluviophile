const subscribe = document.querySelector('#subscribe-btn');
const subscribeFooter = document.querySelector('.subscribe-btn');

/**
 * Add email to subscribers table of the database
 *
 * @param string  input   Value inside input tag
 */
function subscribeEmail(input) {
    let email = {
        'email': document.getElementById(input).value
    }
    fetch(`http://localhost:80/app/helpers/processEmail.php`, {
        method: 'POST',
        header: { "Content-Type": "application/json" },
        body: JSON.stringify(email),
    }).then(function(response) {
        return response.text();
    }).then(function(text) {
        if (text.includes('successfully')) {
            let message = document.getElementsByClassName('message')[0];
            message.innerHTML = `
                                <div id="msg" class="success">
                                    <i class="far fa-check-circle"></i>
                                    <ul>
                                        <li>${text.replace(/(['[\]"]+)/g, '')}</li>
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
            let message = document.getElementsByClassName('message')[0];
            message.innerHTML = `
                                <div id="msg" class="error">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <ul>
                                        <li>${text.replace(/(['[\]"]+)/g, '')}</li>
                                    </ul>
                                    <i class="ti-close"></i>
                                </div>`;
            var msg = document.getElementById("msg");
            msg.classList.add("show");
            setTimeout(function() { msg.className = msg.className.replace("show", ""); }, 4000);
            $('#msg .ti-close').click(function() {
                $('#msg').removeClass('show');
            })
        }

    }).catch(function(error) {
        console.log(error);
    });
}

subscribe.addEventListener('click', async e => {
    subscribeEmail("subscribe-input");
});

subscribeFooter.addEventListener('click', async e => {
    subscribeEmail("input-subscribe");
});