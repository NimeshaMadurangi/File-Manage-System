<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
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
        .thumbnail {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1E2A5E;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Photographer Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  
    <div class="container mt-4">
            
      
        <div class="d-flex mb-4">
            <a href="<?= base_url('upload'); ?>" class="btn btn" style="background-color: #55679C; color: white;">Upload</a>
        </div>

        
        <div class="table-container">
            <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search...">
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
                    <tr>
                        <td>file1.jpg</td>
                        <td>2024-08-10</td>
                        <td>Sample image file</td>
                        <td><img src="file1.jpg" class="thumbnail" alt="Image"></td>
                        <td>
                        <div class="d-flex mb-4">
                                <a href="<?= base_url('edit'); ?>" class="btn btn" style="background-color: #1E2A5E; color: white; margin-right: 10px;">Edit</a>
                                <a href="<?= base_url('delete'); ?>" class="btn btn" style="background-color: #800000; color: white; margin-right: 10px;">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>video1.mp4</td>
                        <td>2024-08-11</td>
                        <td>Sample video file</td>
                        <td><video class="thumbnail" controls><source src="video1.mp4" type="video/mp4"></video></td>
                        <td>
                        <div class="d-flex mb-4">
                                <a href="<?= base_url('edit'); ?>" class="btn btn" style="background-color: #1E2A5E; color: white; margin-right: 10px;">Edit</a>
                                <a href="<?= base_url('delete'); ?>" class="btn btn" style="background-color: #800000; color: white; margin-right: 10px;">Delete</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
