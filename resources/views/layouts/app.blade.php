<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application</title>
    <!-- Include any CSS links or stylesheets here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Your App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- You can include navigation links here -->
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content') <!-- This is where the content from other views will be injected -->
    </main>


    

    <!-- Include any JavaScript scripts or libraries here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
