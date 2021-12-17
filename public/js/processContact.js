$(document).ready(function() {
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            // url: "http://localhost:80/WebProject20211/app/helpers/processContact.php",
            url: $("#contact-form").attr('action'),
            data: $(this).serialize(),
            processData: false,
            contentType: false,
        }).done(function(response){
            console.log(response);
        }).fail(function(data){
            console.log(data);
        });
    })
})