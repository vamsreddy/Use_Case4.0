<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
    <h1>Chatbot Response:</h1>
<body>
    <p>{{ $response }}</p>
    <form method="get" action="{{ route('email-response') }}">
        @csrf
        <input type="hidden" name="response" value="{{ $response }}">
    </form>
</body>
</html>