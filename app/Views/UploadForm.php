<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
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
            background: #1E2A5E;
            border: none;
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }
        button:hover {
            background: #7C93C3;
        }
        button.cancel-btn {
            background: #1E2A5E; 
            color: #fff;
        }
        button.cancel-btn:hover {
            background: #7C93C3;
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
        <?= form_open_multipart('/upload') ?>
            <div class="mb-3">
                <label for="files" class="form-label">Select Images and Videos</label>
                <input type="file" class="form-control" id="files" name="files[]" multiple accept="image/*,video/*">
            </div>
            <div class="mb-3">
                <label for="new_folder" class="form-label">Create New Folder</label>
                <input type="text" class="form-control" id="new_folder" name="new_folder" placeholder="Enter folder name" oninput="toggleExistingFolder()">
            </div>
            <div class="mb-3">
                <label for="existing_folder" class="form-label">Select Existing Folder</label>
                <select class="form-control" id="existing_folder" name="existing_folder" onchange="toggleNewFolder()">
                    <option value="">-- Select a folder --</option>
                    <?php foreach ($existingFolders as $folder): ?>
                        <option value="<?= $folder ?>"><?= $folder ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter a description..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <button type="button" class="btn cancel-btn" onclick="redirectToDashboard()">Cancel</button>
        <?= form_close() ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleNewFolder() {
            const existingFolder = document.getElementById('existing_folder').value;
            document.getElementById('new_folder').disabled = existingFolder !== "";
        }

        function toggleExistingFolder() {
            const newFolder = document.getElementById('new_folder').value.trim();
            document.getElementById('existing_folder').disabled = newFolder !== "";
        }

        function redirectToDashboard() {
            window.location.href = '/admin/dashboard';
        }
    </script>
</body>
</html>
