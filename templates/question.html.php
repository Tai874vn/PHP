<?php include './templates/header.html.php'; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?> 



<div class="mb-4">
    <a href="javascript:history.back()" class="btn btn-primary btn-sm">&larr; Back</a>
</div>

<!-- question card head -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0"><?= htmlspecialchars($question['title']) ?></h4>
            <div class="text-muted small">
                <h6>
                 by 
                <?= htmlspecialchars($question['username'] ?? 'Unknown') ?>
                <?php if ($question['module_name']): ?>
                    in <?= htmlspecialchars($question['module_name']) ?>
                <?php endif; ?>
                </h6>
            </div>
        </div>
        
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $question['user_id']): ?>
            <div>
                <a href="edit.php?id=<?= $question['question_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this question?')">
                    <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

<!-- question card body -->   
    <div class="card-body">
        <div class="question-content mb-4">
            <?= nl2br(htmlspecialchars($question['content'])) ?>
        </div>
            <?php if ($question['image']): 
            $base64Image = base64_encode($question['image']);  
            ?>
            <div class="question-image mb-3">
            <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" class="img-fluid rounded" alt="Question image">
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- answers in question card -->
<h4><?= count($answers) ?> Answer<?= count($answers) != 1 ? 's' : '' ?></h4>
<?php if (count($answers) > 0): ?>
    <?php foreach ($answers as $answer): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-subtitle mb-2 text-muted">
                        Posted by <span style="color: red;"><?= htmlspecialchars($answer['username'] ?? 'Unknown') ?></span>
                        at <span style="color: green;">  <?= $answer['created_at']?></span>
                    </h6>
                    
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $answer['user_id']): ?>
                        <div class="btn-group btn-group-sm">
                            <form method="POST" class="me-1">
                                <button type="button" class="btn btn-outline-secondary toggle-edit-btn" data-id="<?= $answer['answer_id'] ?>">
                                    Edit
                                </button>
                            </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this answer?')">
                                <button type="submit" name="delete_answer" class="btn btn-outline-danger" value="<?= $answer['answer_id'] ?>">
                                    Delete
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                
                <p class="card-text mt-2"><?= nl2br(htmlspecialchars($answer['content'])) ?></p>
                <form method="POST" class="edit-form mt-2" id="edit-form-<?= $answer['answer_id'] ?>" style="display: none;">
                    <div class="mb-2">
                        <textarea name="edited_content" class="form-control" rows="3"><?= htmlspecialchars($answer['content']) ?></textarea>
                    </div>
                    <button type="submit" name="edit_answer" value="<?= $answer['answer_id'] ?>" class="btn btn-sm btn-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-secondary cancel-edit" data-id="<?= $answer['answer_id'] ?>">Cancel</button>
                </form>
                </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-info">No answers yet. Be the first to answer!</div>
<?php endif; ?>

<!-- answer form -->
<?php if (isset($_SESSION['user_id'])):
    include './templates/answer.html.php';
else: ?>
    <div class="alert alert-warning mt-4">
        <a href="login.php">Log in</a> or <a href="register.php">sign up</a> to answer this question.
    </div>
<?php endif; 
include './templates/footer.html.php';
?>

<script>
document.querySelectorAll('.toggle-edit-btn').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const form = document.getElementById(`edit-form-${id}`);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    });
});

document.querySelectorAll('.cancel-edit').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const form = document.getElementById(`edit-form-${id}`);
        form.style.display = 'none';
    });
});
</script>

