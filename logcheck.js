$.ajax({
    url: 'action.php',
    method: 'POST',
    dataType: 'json',
    success: function(data) {
        console.log(data)
        if (data.success === true) {
            console.log ('Logged in: ' + data.message); 
        }
        else {
            console.log('Login failed.');
            window.location.href = 'login.html';
        }
    },
    error: function() {
        console.log('Error');
    }

});