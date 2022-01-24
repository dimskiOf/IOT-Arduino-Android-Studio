var conn = new WebSocket('ws://192.168.100.129:8282');
    var client = {
        user_id: 102,
        recipient_id: null,
        type: 'socket',
        token: null,
        message: null
    };

    conn.onopen = function (e) {
        conn.send(JSON.stringify(client));
        
    };

    conn.onmessage = function (e) {
        var data = JSON.parse(e.data);
        if (data.message) {
            console.log(data.message);
        }
        if (data.type === 'token') {
          //  $('#token').html('JWT Token : ' + data.token);
        }
    };

    
         
     $('#submit').click(function () {
        client.message = 'datascannerupdate';
        client.token = 'a1';
        client.type = 'chat';
        
        client.recipient_id = 101;
        
        conn.send(JSON.stringify(client));
    });
    
    $(document).ready(function(){
    $("#submit").trigger("click");
});
