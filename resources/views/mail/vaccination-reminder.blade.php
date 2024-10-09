
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vaccination Reminder</title>
</head>
<body>
    <h1>Vaccination Reminder</h1>
    <p>Dear {{ $user->name }},</p>
    <p>This is a reminder that your COVID-19 vaccination is scheduled for tomorrow, {{ $scheduledDate }}.</p>

    <p>Please visit the vaccine center: {{ $centerName }} at the scheduled time.</p>

    <p>Thank you for participating in the vaccination drive. Stay safe!</p>
</body>
</html>
