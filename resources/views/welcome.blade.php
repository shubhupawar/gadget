<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column justify-content-center align-items-center vh-100">

    <h1 class="mb-4">Welcome to Our Application</h1>

    <a href="{{ url('/contacts') }}" class="btn btn-primary btn-lg">
        Go to Contacts
    </a>

</body>
</html>
