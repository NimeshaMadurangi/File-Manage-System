<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7C93C3, #ffdde1);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .upload-card {
            border-radius: 20px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .upload-card .form-control {
            border-radius: 30px;
            padding: 10px 15px;
        }
        button {
            background: #1E2A5E; /* Primary button color */
            border: none; /* Remove default border */
            border-radius: 30px; /* Rounded corners */
            padding: 10px; /* Padding inside the button */
            width: 100%; /* Full width button */
            font-size: 16px; /* Font size */
            color: #fff; /* Text color */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background 0.3s ease; /* Smooth background color transition */
            margin-top: 10px; /* Add some space above the button */
        }
        button:hover {
            background: #7C93C3; /* Background color on hover */
        }
        button.cancel-btn {
            background: #1E2A5E; 
            color: #fff; /* Text color */
        }
        button.cancel-btn:hover {
            background: #7C93C3; /* Hover color for cancel button */
        }
        .form-text {
            color: #6c757d;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="upload-card">
        <h2 class="text-center mb-4">Upload Files</h2>
        <form method="post" action="/upload" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="eventname" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="eventname" name="eventname" placeholder="Enter the event name...">
            </div>
            <div class="mb-3">
                <label for="files" class="form-label">Select Images and Videos</label>
                <input type="file" class="form-control" id="files" name="files[]" multiple accept="image/*,video/*">
                <div class="form-text">You can select multiple files (images and videos).</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter a description..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <button type="button" class="btn cancel-btn" onclick="redirectToDashboard()">Cancel</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function redirectToDashboard() {
            window.location.href = '/admin/dashboard';
        }
    </script>
</body>
</html>
