<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Import Export Excel & CSV File - TechvBlogs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 text-center">
        <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="customFile">
            <button class="btn btn-primary">no1 download</button>
        </form>
    </div>
    <div class="container mt-5 text-center">
        <form action="{{ route('download2') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="customFile">
            <input type="text" name="text" id="text">
            <button class="btn btn-primary">no2 download</button>
        </form>
    </div>
    <div class="container mt-5 text-center">
        <form action="{{ route('download3') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="customFile">
            <input type="text" name="text" id="text">
            <select name="select">
                <option>single</option>
                <option>multi</option>
                <option>check</option>
            </select>
            <select name="color">
                <option>red</option>
                <option>blue</option>
                <option>yellow</option>
            </select>
            <button class="btn btn-primary">no3 download</button>
        </form>
    </div>
</body>

</html>