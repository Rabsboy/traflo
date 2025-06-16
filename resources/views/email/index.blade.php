<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <h3>Nama Customer : {{ $detail['name'] }}</h1>
    <h5>E-mail Customer : {{ $detail['email'] }}</h5>
    <p>Pesan : "{{ $detail['message'] }}"</p>
</body>
</html>