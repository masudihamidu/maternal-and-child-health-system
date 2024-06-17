<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #sarufi-chatbox {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <script defer async>
        document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    window.botId = 3930;

    const div = document.createElement("div");
    div.id = "sarufi-chatbox";
    document.body.appendChild(div);

    const script = document.createElement("script");
    script.crossOrigin = true;
    script.type = "module";
    script.src = "https://cdn.jsdelivr.net/gh/flexcodelabs/sarufi-chatbox/example/vanilla-js/script.js";
    document.head.appendChild(script);

    const style = document.createElement("link");
    style.crossOrigin = true;
    style.rel = "stylesheet";
    style.href = "https://cdn.jsdelivr.net/gh/flexcodelabs/sarufi-chatbox/example/vanilla-js/style.css";
    document.head.appendChild(style);

    function overrideSendFunction() {
        const originalSend = window.sarufiChatbox.sendMessage;
        window.sarufiChatbox.sendMessage = function(message) {
            console.log('User message:', message);
            fetch('/save-conversation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ question: message, response: '' })
            })
            .then(response => response.json())
            .then(data => console.log('Response data:', data))
            .catch(error => console.error('Error:', error));

            originalSend.apply(window.sarufiChatbox, arguments);
        };

        const originalHandleResponse = window.sarufiChatbox.handleResponse;
        window.sarufiChatbox.handleResponse = function(response) {
            console.log('Bot response:', response);
            fetch('/save-conversation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ question: '', response: response })
            })
            .then(response => response.json())
            .then(data => console.log('Response data:', data))
            .catch(error => console.error('Error:', error));

            originalHandleResponse.apply(window.sarufiChatbox, arguments);
        };
    }

    script.onload = function() {
        overrideSendFunction();
    };
});

    </script>
</body>
</html>
