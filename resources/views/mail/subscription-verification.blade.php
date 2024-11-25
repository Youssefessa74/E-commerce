<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription Verification</title>
</head>
<body>

  <a href="{{ route('subscribe.verify',$subscriber->verified_token) }}"> <p>Click the link to verify your e-mail</p></a>
</body>
</html>
