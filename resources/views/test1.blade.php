<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Recommendations</title>
</head>

<body>
    <h1>Tutor Recommendations for User </h1>

    <ul>
        @foreach ($similarTutors as $tutor)
            <div class="row">
                <div>
                    Tutor ID: {{ $tutor['tutor_id'] }} | ค่าความเหมือน: {{ $tutor['cosine_similarity'] }}
                </div>

            </div>
        @endforeach

    </ul>
</body>

</html>
