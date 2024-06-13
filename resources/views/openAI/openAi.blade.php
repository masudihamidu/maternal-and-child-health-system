<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Screen Chatbox</title>
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
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // setting global variables
            window.botId = 3930;

            // create div with id = sarufi-chatbox
            const div = document.createElement("div");
            div.id = "sarufi-chatbox";
            document.body.appendChild(div);

            // create and attach script tag
            const script = document.createElement("script");
            script.crossOrigin = true;
            script.type = "module";
            script.src = "https://cdn.jsdelivr.net/gh/flexcodelabs/sarufi-chatbox/example/vanilla-js/script.js";
            document.head.appendChild(script);

            // create and attach css
            const style = document.createElement("link");
            style.crossOrigin = true;
            style.rel = "stylesheet";
            style.href = "https://cdn.jsdelivr.net/gh/flexcodelabs/sarufi-chatbox/example/vanilla-js/style.css";
            document.head.appendChild(style);

            // Override send function to capture user questions and bot responses
            function overrideSendFunction() {
                const originalSend = window.sarufiChatbox.sendMessage;
                window.sarufiChatbox.sendMessage = function(message) {
                    // Send user question to the backend
                    fetch('/save-conversation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ question: message, response: '' })
                    })
                    .then(response => response.json())
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));

                    // Call the original send function
                    originalSend.apply(window.sarufiChatbox, arguments);
                };

                // Override the function that handles bot responses
                const originalHandleResponse = window.sarufiChatbox.handleResponse;
                window.sarufiChatbox.handleResponse = function(response) {
                    // Send bot response to the backend
                    fetch('/save-conversation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ question: '', response: response })
                    })
                    .then(response => response.json())
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));

                    // Call the original handle response function
                    originalHandleResponse.apply(window.sarufiChatbox, arguments);
                };
            }

            // Wait until the chatbox script is loaded
            script.onload = function() {
                overrideSendFunction();
            };
        });
    </script>
</body>
</html>
