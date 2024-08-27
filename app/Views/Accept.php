<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery-item {
            margin-bottom: 20px;
        }
        .gallery-item img,
        .gallery-item video {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .gallery-item .caption {
            text-align: center;
            margin-top: 10px;
        }
        .action-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }
        .action-icons i {
            cursor: pointer;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        .action-icons .download-icon:hover {
            color: #D61355;
        }
        .action-icons .share-icon:hover {
            color: #D61355;
        }
        .gallery-item .caption p {
            color: #555;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1E2A5E;">
        <div class="container-fluid">
            <h1 class="navbar-brand" href="#">Approved List</h1>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php if (!empty($uploads)) : ?>
                <?php foreach ($uploads as $row) : ?>
                    <div class="col-md-4 col-sm-6 gallery-item">
                        <div class="card">
                            <div class="card-body">
                               
                                <?php if (in_array(pathinfo($row['filename'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])): ?>
                                    <img src="<?= base_url('uploads/' . $row['filename']); ?>" alt="Preview">
                                <?php elseif (in_array(pathinfo($row['filename'], PATHINFO_EXTENSION), ['mp4', 'avi'])): ?>
                                    <video controls>
                                        <source src="<?= base_url('uploads/' . $row['filename']); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php endif; ?>
                               
                                <div class="caption">
                                    <p><strong><?= esc($row['filename']); ?></strong></p>
                                    <p><?= esc($row['description']); ?></p>
                                    <p><small><?= esc($row['created_at']); ?></small></p>
                                   
                                    <div class="action-icons">
                                        <a href="<?= base_url('uploads/' . $row['filename']); ?>" download>
                                            <i class="fas fa-download download-icon"></i>
                                        </a>
                                        <i class="fas fa-share-alt share-icon" onclick="shareContent('<?= base_url('uploads/' . $row['filename']); ?>')"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No approved uploads found</p>
            <?php endif; ?>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <script>
        function shareContent(url) {
            if (navigator.share) {
                navigator.share({
                    title: 'Check this out!',
                    url: url
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(console.error);
            } else {
                alert('Sharing not supported in this browser.');
            }
        }
    </script>
</body>
</html>
