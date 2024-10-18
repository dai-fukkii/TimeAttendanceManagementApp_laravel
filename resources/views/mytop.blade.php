<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyTop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* 上記で記載したCSSをここに追加 */
    </style>
</head>

<body>
    <div class="container">
        <h1>勤怠管理システム</h1>

        @if (Auth::check())
        @else
        @endif
        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif  

        @if ($userInfo)
            <p>ID: {{ $userInfo->id }}</p>
            <p>名前: {{ $userInfo->username }}</p>
        @endif

        <div class="attendance-buttons">
            <button type="button" class="attendance" id="clock_in" data-action="clock_in">出勤</button>
            <button type="button" class="attendance" id="break_in" data-action="break_in">休憩開始</button>
            <button type="button" class="attendance" id="break_out" data-action="break_out">休憩終了</button>
            <button type="button" class="attendance" id="clock_out" data-action="clock_out">退勤</button>
        </div>

        <div id="message"></div>

        <div class="attendance-buttons">
            <button type="button" id="log">勤怠ログ</button>
        </div>

        <div id="logData"></div>
    </div>

    <script>
        

        $(function () {

            function setButtonAttribute(status){
                $('.attendance').prop('disabled',false);
                switch(status){
                    case 'clock_in':
                        $('#clock_in,#break_out').prop('disabled',true);
                        break;
                    case 'break_in':
                        $('#clock_in,#break_in,#clock_out').prop('disabled',true);
                        break;
                    case 'break_out':
                        $('#clock_in,#break_out').prop('disabled',true);
                        break;
                    case 'clock_out':
                        $('#break_in,#break_out,#clock_out').prop('disabled',true);
                        break;
                    default:
                }
            }

            $(document).ready(function(){
                let status = @json(session('status'));
                setButtonAttribute(status.status);
            });


            $('.attendance').click(function () {
                let status = $(this).data('action');
                $('.attendance').prop('disabled',false);

                $.ajax({
                    url: '{{ route("mytop.store") }}',
                    type: "POST",
                    data: { action: status },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                }).done(function (data) {

                    let att;
                    switch (data.status){
                        case 'clock_in':
                            att = '出勤';
                            break;
                        case 'break_in':
                            att = '休憩開始';
                            break;
                        case 'break_out':
                            att = '休憩終了';
                            break;
                        case 'clock_out':
                            att = '退勤';  
                            break;          
                    }

                    if (data.error) {
                        $('#message').html(`<p>${data.error}</p>`);
                    } else {
                        $('#message').html(`
                            <p>${data.message}</p>
                            <p>ステータス: ${att}</p>
                            <p>時間: ${data.current_time}</p>
                        `);
                    }

                    setButtonAttribute(data.status);

                }).fail(function (xhr) {
                    $('#message').text('エラーが発生しました。');
                });
            });

            $('#log').click(function () {
                $.ajax({
                    url: '{{ route("mytop.logs") }}',
                    method: 'GET',
                }).done(function (data) {
                    if (data.error) {
                        $('#logData').html(`
                            <p>${data.message}</p>
                            <p>${data.error}</p>
                        `);
                    } else {
                        let log_html = `<ul>`;
                        data.logs.forEach(log => {
                            log_html += `<li>${log.status} - ${log.created_at}</li>`;
                        });
                        log_html += `</ul>`;
                        $('#logData').html(log_html);
                    }
                }).fail(function (xhr) {
                    alert('ログの取得に失敗しました。');
                });
            });
        });

        


        
    </script>
</body>

</html>
