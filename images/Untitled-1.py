
    $('.search-ipt').on('input',function () {
        let val=localStorage.getItem('record')||''
        if (val!=''){
            $('.history').css('display','block')
            $('.history').html('<a href="/?search='+val+'">'+val+'</a>')
        }else{
            $('.history').css('display','none')
        }
    })
    $('.search-btn').click(function () {
        let val = $('.search-ipt').val()
        localStorage.setItem('record',val)
        }
    )