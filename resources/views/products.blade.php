<!DOCTYPE html>
<html>
<head>
    <title>Electric Store</title>
</head>
<body>
    <h1>Available Products</h1>
    
    <ul>
        @php
            $points = explode("\n", $response); // Split the response into points
        @endphp

        @foreach ($points as $point)
            <li>{{ $point }}</li>
        @endforeach
    </ul>
    
</body>
</html>
