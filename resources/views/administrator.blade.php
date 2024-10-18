<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adoministrator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @if ($userInfo)
        <p>ID: {{ $userInfo->id }}</p>
        <p>UserName: {{ $userInfo->username }}</p>
    @endif

    <select id="attSelect">
        <option value="non">-</option>
        <option value="active">勤務中</option>
        <option value="break">休憩中</option>
        <option value="inactive">退勤中</option>
        <option value="others">その他</option>
    </select>

    <div id="statusResult"></div>

    <script>
        function fetchUserInfo(status){

            $.ajax({
                'url':"{{ route('administrator.status') }}",
                'method':'GET',
                'data': {status: status},
            }).done(function(data){
                    let logHtml = `<ul>`
                    data.logs.forEach(
                        log=>{
                            logHtml+=`<li>${log.user_id}-${log.username} (${log.created_at})</li>`;
                        }
                    )
                    logHtml += `</ul>`;

                    $('#statusResult').html(logHtml);
                }
            ).fail(function(){
                    $('#statusResult').html(`
                        <p></p>
                    `);
                }
            );

        }

        $(function(){

            $('#attSelect').on('change', function(){
                const status =  $('#attSelect').val();
                fetchUserInfo(status);
            })

            setInterval(() => {
                const status =  $('#attSelect').val();
                fetchUserInfo(status);
            }, 5000);
        });
        
    </script>

</body>
</html>