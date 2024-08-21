<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .navbar-dark-red {
            background-color: #8B0000;
        }
        .card {
            border-radius: 10px;
        }
        .card-body {
            text-align: center;
            position: relative;
        }
        .card-body i {
            font-size: 2.5rem;
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.2;
        }
        .search-bar {
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }
        .table-container {
            overflow-x: auto;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }
        .table td img.thumbnail,
        .table td video.thumbnail {
            width: 150px; /* Increased size */
            height: auto;
        }
        .toggle-switch {
            position: relative;
            width: 40px;
            height: 20px;
            display: inline-block;
        }
        .toggle-switch input {
            display: none;
        }
        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 34px;
            transition: 0.4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #4CAF50;
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }
        .table th:nth-child(4), /* Preview column */
        .table td:nth-child(4) {
            width: 200px; /* Increased width for Preview column */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1E2A5E;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manager Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Accept List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Table with Search -->
        <div class="table-container">
            <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search...">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Preview</th>
                        <th>Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if (!empty($uploads)) : ?>
                        <?php foreach ($uploads as $upload) : ?>
                            <tr>
                                <td><?= esc($upload['filename']); ?></td>
                                <td><?= esc($upload['created_at']); ?></td>
                                <td><?= esc($upload['description']); ?></td>
                                <td>
                                    <?php 
                                    $filePath = base_url('uploads/' . $upload['filename']);
                                    $fileExt = pathinfo($upload['filename'], PATHINFO_EXTENSION);
                                    if (in_array($fileExt, ['jpg', 'jpeg', 'png'])): ?>
                                        <img src="<?= $filePath; ?>" class="thumbnail" alt="Image">
                                    <?php elseif (in_array($fileExt, ['mp4', 'avi'])): ?>
                                        <video class="thumbnail" controls>
                                            <source src="<?= $filePath; ?>" type="video/<?= $fileExt; ?>">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php else: ?>
                                        <p>Unsupported file type</p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <label class="toggle-switch">
                                        <input type="checkbox" <?= $upload['approve'] ? 'checked' : ''; ?> data-id="<?= $upload['id']; ?>" class="approval-toggle">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex mb-4">
                                        <a href="<?= base_url('download/' . $upload['filename']); ?>" class="btn btn" style="background-color: #43766C; color: white;">Download</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="6">No data found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Script -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Toggle switch script to update approval status
        document.querySelectorAll('.approval-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const id = this.dataset.id;
                const isChecked = this.checked;
                
                fetch('<?= base_url('update_approval_status'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id, approved: isChecked })
                }).then(response => response.json())
                  .then(data => {
                      if (!data.success) {
                          alert('Failed to approve');
                      }
                  }).catch(error => {
                      console.error('Error:', error);
                      alert('Error updating approval');
                  });
            });
        });
    </script>
</body>
</html>
