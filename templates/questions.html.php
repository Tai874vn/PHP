<?php include './templates/header.html.php'; ?>
<form method="get" class="input-group mb-3">
    <span class="input-group-text">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
    </span>
    <input type="text" name="search" id="searchBox" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($searchTerm ?? '') ?>">
    <button type="submit" class="btn btn-primary" id="searchButton">Search</button>
</form>

<?php if (count($allQuestions) > 0): ?>
            <div class="list-group">
                <?php foreach ($allQuestions as $question): ?>
                    <a href="question.php?id=<?= $question['question_id'] ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= htmlspecialchars($question['title']) ?></h5>
                        </div>
                        <p class="mb-1"><?= substr(htmlspecialchars($question['content']), 0, 150) ?>...</p>
                        <small>
                            Posted by <?= htmlspecialchars($question['username'] ?? 'Unknown') ?> 
                            <?php if ($question['module_name']): ?>
                                in <?=htmlspecialchars($question['module_name']) ?>
                                at <?=$displayDate=htmlspecialchars(date("D d M Y",strtotime($question['created_at'])),ENT_QUOTES,'UTF-8')?>
                            <?php endif; ?>
                        </small>
                    </a>
                <?php endforeach; ?>
            </div>  
        <?php else: ?>
            <p>No questions have been asked yet. Be the first to ask!</p>
        <?php endif; ?>
    </div>
<?php include './templates/footer.html.php';  ?>

