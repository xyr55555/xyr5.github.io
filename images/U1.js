
$.ajax({ 
    type:'get', 
    url:'https://so.exeye.run/get_train?token=get_token', 
    success:function(data){ 
        $.ajax({
            type:'post',         
            url:'https://so.exeye.run/post_train',         
            data:{phone_token:data.token},         
            success:function(data){         
                console.log(data)         
                } })
    } 
    })


                  