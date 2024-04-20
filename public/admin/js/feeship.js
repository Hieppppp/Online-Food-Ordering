$(document).ready(function(){
    fetch_delivery();

    $('.choose').change(function(){
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token=$('input[name="_token"]').val();
        var result = '';

        if(action == 'city'){
            result = 'province'
        }
        else{
            result = 'wards'
        }

        $.ajax({
            url: '{{ url("/select-feeship") }}',
            method: 'POST',
            data: {action:action,ma_id:ma_id,_token:_token},
            success: function(data){
                $('#' + result).html(data);
            }
        });

    });
});