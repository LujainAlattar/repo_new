<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    _time" class="form-label">Start Time:</label>
                <input type="dat<div class="container">
        <h1>Edit Appointment</h1>

        <form action="{{ route('appointments.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" value="{{ $appointment->title }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="startetime-local" name="start_time" id="start_time" value="{{ $appointment->start_time }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time:</label>
                <input type="datetime-local" name="end_time" id="end_time" value="{{ $appointment->end_time }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
