<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Breakdown</title>
    <style>
        .even { color: red; font-weight: bold; }
        .odd { color: green; font-weight: bold; }
        .bullets{ list-style-type: none; padding: 0; margin: 0; }
    </style>
</head>
<body>
    <h3>Fionah Santua/3A/Activity 7</h3>
    <h3>Money: 
        <span class="{{ $OrigMoney % 2 == 0 ? 'even' : 'odd' }}">
            {{ $OrigMoney}}
        </span>
    </h3>
    <ul class="bullets">
        @foreach ($breakdown as $denomination => $count)
            <li>{{ $denomination }}: {{ $count }}</li>
        @endforeach
    </ul>

    <h5>In Words: {{ $word }}</h5>

</body>
</html>