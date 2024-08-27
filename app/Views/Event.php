<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create or Select Folder</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create a New Folder or Select an Existing One</h1>

        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
               
                <form action="<?= base_url('event/manage-folder') ?>" method="post">
                    <div class="mb-3">
                        <label for="new_folder" class="form-label">Create New Folder:</label>
                        <input type="text" class="form-control" id="new_folder" name="new_folder" placeholder="Enter folder name" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create Folder</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                
                <form action="<?= base_url('file/manage-folder') ?>" method="post">
                    <div class="mb-3">
                        <label for="existing_folder" class="form-label">Select Existing Folder:</label>
                        <select class="form-select" id="existing_folder" name="existing_folder" required>
                            <option value="" disabled selected>Select a folder</option>
                            <?php foreach ($existingFolders as $folder): ?>
                                <option value="<?= $folder ?>"><?= $folder ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Select Folder</button>
                </form>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
