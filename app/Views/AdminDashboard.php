<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <!-- Navbar -->
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
                        <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logoutLink">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Users Count Card -->
            <div class="col-md-3 mb-4">
                <div class="card text-white" style="background-color: #7C93C3;">
                    <div class="card-body">
                        <i class="fa-solid fa-users"></i>
                        <h5 class="card-title">Users</h5>
                        <p class="card-text fs-1"><?= esc($userCount); ?></p>
                    </div>
                </div>
            </div>
            <!-- Add other cards here -->
        </div>

        <!-- Buttons -->
        <div class="d-flex mb-4">
            <a href="<?= base_url('register'); ?>" class="btn btn" style="background-color: #55679C; color: white; margin-right: 10px;">Register</a>
            <a href="<?= base_url('upload'); ?>" class="btn btn" style="background-color: #55679C; color: white;">Upload</a>
        </div>

        <!-- Table with Search -->
        <div class="table-container">
            <input type="text" id="searchInput" class="form-control search-bar mb-3" placeholder="Search...">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Preview</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                <?php if (!empty($results)) : ?>
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?php echo esc($row['filename']); ?></td>
                            <td><?php echo esc($row['created_at']); ?></td> <!-- Ensure the column exists -->
                            <td><?php echo esc($row['description']); ?></td>
                            <td>
                                <!-- Preview content, e.g., thumbnail for images -->
                                <?php if (in_array(pathinfo($row['filename'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])): ?>
                                    <img src="<?= base_url('uploads/' . $row['filename']); ?>" alt="Preview" style="width: 100px;">
                                <?php elseif (in_array(pathinfo($row['filename'], PATHINFO_EXTENSION), ['mp4', 'avi'])): ?>
                                    <video width="100" controls>
                                        <source src="<?= base_url('uploads/' . $row['filename']); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('download/' . $row['filename']); ?>" class="btn btn-sm btn-primary">Download</a>
                                <a href="<?= base_url('edit/' . $row['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('delete/' . $row['id']); ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="5">No data found</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Script -->
    <script>
        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            if (confirm('Are you sure you want to logout?')) {
                // If user clicks "OK", redirect to the logout route
                window.location.href = '/logout';
            }
        });

        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
