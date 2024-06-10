<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background: #343541;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #2a2b32;
        }

        ::-webkit-scrollbar-thumb {
            background: #555555;
        }

        .header {
            background: #202123;
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            border-bottom: 1px solid #555555;
        }

        .chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background: #343541;
        }

        .message {
            border-radius: 8px;
            font-size: 85%;
            margin-bottom: 10px;
            padding: 10px;
            max-width: 80%;
            clear: both;
        }

        .user-message {
            background-color: #4caf50;
            float: right;
            text-align: right;
            margin-left: auto;
        }

        .bot-response {
            background-color: #40414F;
            color: white;
            float: left;
            margin-right: auto;
        }

        .input-container {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #202123;
            border-top: 1px solid #555555;
        }

        .input-container input {
            background: #555555;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            flex: 1;
        }

        .input-container button {
            background: #4caf50;
            border: none;
            color: white;
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="avatar" style="width: 30px; height: 30px; background: gray; border-radius: 50%;"></div>
        <div class="username" style="margin-left: 10px;">Chat with GPT</div>
    </div>

    <div id="content-box" class="chat-box">
        @if (isset($conversation))
            @foreach ($conversation as $exchange)
                <div class="message user-message">
                    {{ $exchange['user'] }}
                </div>
                <div class="message bot-response">
                    {{ $exchange['bot'] }}
                </div>
            @endforeach
        @endif
    </div>

    <div class="footer input-container">
        <input id="input" type="text" name="input" placeholder="Type your message here..." />
        <button id="button-submit"><i class="fa fa-paper-plane"></i></button>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#button-submit').on('click', function() {
            const value = $('#input').val();
            if (!value) return;

            $('#content-box').append(`
                <div class="message user-message">
                    ${value}
                </div>
            `);

            $.ajax({
                type: 'POST',
                url: '{{ url('/sendChat') }}',
                data: { prompt: value },
                success: function(data) {
                    $('#content-box').append(`
                        <div class="message bot-response">
                            ${data}
                        </div>
                    `);
                    $('#input').val('');
                    $('#content-box').scrollTop($('#content-box')[0].scrollHeight);
                }
            });
        });

        $('#input').on('keypress', function(e) {
            if (e.which === 13) {
                $('#button-submit').click();
            }
        });
    </script>
</body>
</html>
