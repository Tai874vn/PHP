<?php include './templates/header.html.php'; ?>
<div class="alert alert-success fs-6 text-center rounded" role="alert">TIP: remember to be specific when asking to get the best answer</div>
<h1>Ask a Question</h1>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" id="create">
    <div class="mb-3">
        <label for="title" class="form-label">Question Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $_POST['title'] ?? '' ?>" placeholder="Put your title here" >
    </div> 
    
    <div class="mb-3">
        <label for="content" class="form-label">Question Details</label>
        <textarea class="form-control" id="content" name="content" rows="6" placeholder="Put your question here"><?= $_POST['content'] ?? '' ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="module_id" class="form-label">Module (Optional)</label>
        <select class="form-select" id="module_id" name="module_id">
            <option value="">-- Select Module --</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['module_id'] ?>" <?= (isset($_POST['module_id']) && $_POST['module_id'] == $module['module_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($module['module_name']) ?> (<?= htmlspecialchars($module['module_code']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="image" class="form-label">Upload Screenshot (Optional)</label>
        <input class="form-control" type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/gif">
        <div class="form-text">JPG, JPEG, PNG or GIF only.</div>
    </div>
                                                           
    <button type="submit" class="btn btn-primary">Post Your Question</button>
</form>

<?php include './templates/footer.html.php';?>
