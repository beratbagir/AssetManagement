<!DOCTYPE html>
<html>
<head>
    <title>Licence Expiry Reminder</title>
</head>
<body>
    <h2>Licence Expiry Reminder</h2>
    <p>The following licences are expiring soon:</p>
    <ul>
        @foreach($licences as $licence)
            <li>{{ $licence->licence_key }} (Expiry Date: {{ $licence->expiration_date }})</li>
        @endforeach
    </ul>
</body>
</html>
