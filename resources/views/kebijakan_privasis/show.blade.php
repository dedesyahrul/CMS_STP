<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Teman Publik - Privacy</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your custom CSS styles here */
        /* Reset some default styles */
        body,
        h1,
        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
        }

        /* Center the content horizontally and vertically */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7fafc;
            font-family: Arial, sans-serif;
        }

        /* Style for the container */
        .container {
            width: 794px;
            /* A4 width */
            height: 1123px;
            /* A4 height */
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Style for the heading */
        .container h3 {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 10px;
        }

        /* Style for the content */
        .container p {
            font-size: 16px;
            color: #666666;
            line-height: 1.6;
            text-align: justify;
            /* Justify the text content */
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($kebijakanPrivasis as $kebijakanPrivasi)
            <br>
            <h3>{{ $kebijakanPrivasi->judul }}</h3>
            <br>
            <p>{{ $kebijakanPrivasi->isi }}</p>
        @endforeach
    </div>

    <!-- Add Bootstrap JS and other dependencies if needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
