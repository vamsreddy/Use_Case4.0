<!DOCTYPE html>
<html>
<head>
    <title>Chatbot Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            padding: 10px;
            color: #fff;
            display: flex;
        }

        .navbar h1 {
            margin: 0;
            padding: 0;
            font-size: 20px;
        }

        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .chat-container h1 {
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message-container {
            margin-bottom: 20px;
        }

        .message-container.system .message {
            font-style: italic;
            color: #999999;
        }

        .message-container.user .message {
            background-color: #def3fd;
            color: #333333;
            padding: 10px;
            border-radius: 5px;
        }

        .message-container.bot .message {
            background-color: #e8e8e8;
            color: #333333;
            padding: 10px;
            border-radius: 5px;
        }

        .message-container.bot .message .answer {
            font-weight: bold;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .input-container input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .input-container button {
            flex-shrink: 0;
            padding: 8px;
            width: 50px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
        }


        .submit-button {
            font-size: 16px;
            padding: 8px;
            width: 80px; /* Adjust the width value as needed */
            box-sizing: border-box;
        }


    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<body>
    <div>
    <div class="navbar">
        <h1>Chatbot Example</h1>
    </div>
    <div class="navbar">
        <a href="chat" style="color:white" >Chatbot Text</a>
    </div>
    <div class="navbar">
        <a href="image" style="color:white">Chatbot Image</a>
    </div>
    <div class="navbar">
        <a href="openai" style="color:white">UseCase 1.1</a>
    </div>
</div>


@yield('content');
</div>
</body>
</html>
