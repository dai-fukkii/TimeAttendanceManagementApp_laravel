<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyTop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('js/log_get.js') }}"></script> --}}
</head>
<body>

    <p>ユーザ名</p>
    @if ($userInfo)
        {{ $userInfo->id }}
        <br>
        {{ $userInfo->username }}
    @endif
    <form action="{{ route('mytop') }}" method="post">
        @csrf
        <div>
            <button type="submit">出勤</button>
        </div>
        <div>
            <button type="submit">休憩開始</button>
        </div>
        <div>
            <button type="submit">休憩終了</button>
        </div>
        <div>
            <button type="submit">退勤</button>
        </div>
    </form>
    <div>
        <button type="submit" id="log">ログ</button>
    </div>
    <div id="logData"></div>
    <!-- モーダル -->
     {{-- <div id="modal" style="display:none;">
         <div id="modal-content">
             <span id="close">&times;</span>
             <div id="logData"></div> <!-- 取得したデータを表示するためのDIV -->
         </div>
     </div> --}}
    
    <script>
        $(function(){

            $('#log').click(function(){
                $.ajax({
                    url: '{{ route("test") }}',
                    method: 'GET',
                    success: function(data) {
                        $('#logData').html(data);
                    },
                    error: function(xhr) {
                        alert('ログの取得に失敗しました。');
                    }
                });
            });

        });
    </script>
    {{-- <style>
        /* モーダルのスタイル（必要に応じて） */
        #modal {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        #modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        #close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        #close:hover,
        #close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style> --}}
</body>
</html>