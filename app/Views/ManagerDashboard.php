<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .navbar-dark-red {
            background-color: #8B0000;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
            height: 250px;
        }
        .card-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .card-body {
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }
        .card-body i {
            font-size: 1.5rem;
        }
        .search-bar {
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .gallery-item {
            width: calc(25% - 20px); 
        }
        .gallery-item img,
        .gallery-item video {
            width: 100%;
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
    </style>
</head>
<body>
 
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
                        <a class="nav-link" href="/approved-uploads">Accept List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logoutLink">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
      
        <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search...">
       
        <div class="gallery">
            <?php if (!empty($uploads)) : ?>
                <?php foreach ($uploads as $upload) : ?>
                    <div class="card gallery-item">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($upload['filename']); ?></h5>
                            <label class="toggle-switch">
                                <input type="checkbox" <?= $upload['approve'] ? 'checked' : ''; ?> data-id="<?= $upload['id']; ?>" class="approval-toggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <?php 
                        $filePath = base_url('uploads/' . $upload['filename']);
                        $fileExt = pathinfo($upload['filename'], PATHINFO_EXTENSION);
                        if (in_array($fileExt, ['jpg', 'jpeg', 'png'])): ?>
                            <img src="<?= $filePath; ?>" class="card-img" alt="Image">
                        <?php elseif (in_array($fileExt, ['mp4', 'avi'])): ?>
                            <video class="card-img" controls>
                                <source src="<?= $filePath; ?>" type="video/<?= $fileExt; ?>">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <p>Unsupported file type</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">No data found</div>
            <?php endif; ?>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const cards = document.querySelectorAll('.gallery-item');
            cards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                card.style.display = title.includes(filter) ? '' : 'none';
            });
        });

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
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Failed to approve');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating approval');
                });
            });
        });
    </script>

    
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
