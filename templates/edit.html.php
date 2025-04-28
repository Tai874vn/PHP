<?php include './templates/header.html.php'; ?>
<h1>Edit Question</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>




<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Question Title</label>
        <input type="text" class="form-control" id="title" name="title" 
               value="<?= htmlspecialchars($_POST['title'] ?? $question['title']) ?>">
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Question Details</label>
        <textarea class="form-control" id="content" name="content" rows="6"><?= htmlspecialchars($_POST['content'] ?? $question['content']) ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="module_id" class="form-label">Module (Optional)</label>
        <select class="form-select" id="module_id" name="module_id">
            <option value="">-- Select Module --</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['module_id'] ?>" <?= (isset($_POST['module_id']) ? $_POST['module_id'] : $question['module_id']) == $module['module_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($module['module_name']) ?> (<?= htmlspecialchars($module['module_code']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <?php if ($question['image']): 
            $base64Image = base64_encode($question['image']);  
            ?>
            <div class="mb-2">
                <label class="form-label">Current Image</label>
                <div>
                    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>"  class="img-thumbnail" style="max-height: 200px;" alt="Question image">
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                    <label class="form-check-label" for="remove_image">Remove image</label>
                </div>
            </div>
        <?php endif; ?>
        
        <label for="image" class="form-label">Upload New Screenshot</label>
        <input class="form-control" type="file" id="image" name="image" accept="image/*">
        <div class="form-text text-dark">JPEG,JPG PNG or GIF only.</div>
    </div>
    <button type="submit" class="btn btn-primary">Update Question</button>
    <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
</form>

<?php include './templates/footer.html.php';?>
