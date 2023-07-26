<!DOCTYPE html>
<html>
    <title>ChatGPT - OpenAI Input</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .message-container {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .message-container.bot {
            justify-content: flex-end;
        }

        .message {
            padding: 10px 15px;
            border-radius: 6px;
            background-color: #e1e1e1;
            color: #000;
            max-width: 70%;
        }

        .message.bot {
            background-color: #007bff;
            color: #fff;
        }

        .input-container {
            display: flex;
            margin-top: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px 0 0 6px;
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
        }

        /* Style for OpenAI Input Form */
        label {
            display: block;
            font-size: 20px;
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            height: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            resize: none;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    {{-- @extends('layout')
    @section('content') --}}
    <div class="chat-container">
        <h1>OpenAI Response</h1>
    <div class="message-container bot">
        <div class="message">
            <span class="answer">Welcome to OpenAI!</span>
        </div>
    </div>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('openai.process') }}" method="post">
        @csrf
        <div class="input-container">
            <input type="text" name="message" id="message" placeholder="Type your message...">
            <button type="submit" class="submit-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</body>
</html>
    {{-- @endsection --}}
