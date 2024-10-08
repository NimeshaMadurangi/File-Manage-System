<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .gallery-item {
            border: 2px solid #ddd;
            border-radius: .25rem;
            overflow: hidden;
            margin-bottom: 1rem;
            height: 400px;
            display: flex;
            flex-direction: column;
        }
        .gallery-item img, .gallery-item video {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .gallery-item .card-body {
            padding: .75rem;
            flex: 1;
            overflow: hidden;
        }
        .gallery-item .btn {
            margin-right: .5rem;
        }
        .navbar-dark .navbar-nav .nav-link.active {
            background-color: #55679C;
            border-radius: .25rem;
        }
        @media (max-width: 768px) {
            .gallery-item {
                margin-bottom: .5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1E2A5E;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">User List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/approved-uploads">Accept List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logoutLink">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Success and Error Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-4">
                <div class="card text-white" style="background-color: #7C93C3;">
                    <div class="card-body d-flex flex-column align-items-center">
                        <i class="fa-solid fa-users fa-2x mb-2"></i>
                        <h5 class="card-title">Users</h5>
                        <p class="card-text fs-1"><?= esc($userCount); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white" style="background-color: #7C93C3;">
                    <div class="card-body d-flex flex-column align-items-center">
                        <i class="fa-solid fa-file fa-2x mb-2"></i>
                        <h5 class="card-title">Files</h5>
                        <p class="card-text fs-1"><?= esc($fileCount); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex mb-4">
            <a href="<?= base_url('register'); ?>" class="btn btn" style="background-color: #55679C; color: white; margin-right: 10px;">Register</a>
            <a href="<?= base_url('upload'); ?>" class="btn btn" style="background-color: #55679C; color: white;">Upload</a>
        </div>

        <!-- Search Form -->
        <div class="mb-4">
            <form method="get" action="<?= base_url('admin/dashboard'); ?>">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search uploads..." value="<?= esc($searchQuery); ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <!-- Uploads Gallery -->
        <div class="row">
            <?php foreach ($uploads as $row) : ?>
                <div class="col-md-3 mb-4">
                    <div class="gallery-item card">
                        <div class="card-body d-flex flex-column">
                            <?php 
                            $filePath = base_url('uploads/' . $row['filename']);
                            $fileExtension = strtolower(pathinfo($row['filename'], PATHINFO_EXTENSION));
                            ?>

                            <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])): ?>
                                <img src="<?= $filePath; ?>" alt="Preview">
                            <?php elseif (in_array($fileExtension, ['mp4', 'avi'])): ?>
                                <video controls>
                                    <source src="<?= $filePath; ?>" type="video/<?= $fileExtension; ?>">
                                    Your browser does not support the video tag.
                                </video>
                            <?php else: ?>
                                <p>Unsupported file type</p>
                            <?php endif; ?>

                            <h5 class="card-title mt-2"><?= esc($row['filename']); ?></h5>
                            <p class="card-text"><?= esc($row['description']); ?></p>
                            <p class="card-text text-muted"><?= esc($row['created_at']); ?></p>

                            <div class="mt-auto">
                                <a href="<?= base_url('download/' . $row['filename']); ?>" class="btn btn-sm" style="background-color: #254336; color: white;">Download</a>
                                <a href="<?= base_url('edit/' . $row['id']); ?>" class="btn btn-sm" style="background-color: #E0A75E; color: white;">Edit</a>
                                <a href="<?= base_url('delete/' . $row['id']); ?>" class="btn btn-sm" style="background-color: #800000; color: white;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '/logout';
            }
        });
    </script>
</body>
</html>
