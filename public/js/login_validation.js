$(document).ready(function(){

    $('#username').on('input',function(){
        let username = $('#username').val();

        if((username.length<6||username.length>50) || !/^[a-zA-Z0-9]+$/.test(username)){
            $('#username')[0].setCustomValidity('ユーザ名は6文字以上50文字以下の英数字で入力してください');
        }else{
            $('#username')[0].setCustomValidity('');
        }
    });

    $('#password').on('input', function(){
        let password = $('#password').val();

        if(password.length <6 || !/^[a-zA-Z0-9]+$/.test(password)){
            $('#password')[0].setCustomValidity('パスワードは6文字以上の英数字で入力してください');
        }else{
            $('#password')[0].setCustomValidity('');
        }

    });

    }
);