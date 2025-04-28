<?php include './templates/header.html.php';?>
<div class="jumbotron bg-light p-5 rounded shadow-lg">
    <h1 class="display-4">Student Questions Platform</h1>
    <p class="lead">Get started by asking questions and helping others.</p>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="register.php" class="btn btn-primary btn-lg">Sign Up</a>
        <a href="login.php" class="btn btn-secondary btn-lg">Login</a>
    <?php else: ?>
        <a href="createQuestion.php" class="btn btn-primary btn-lg">Ask a Question</a>
        <a href="none.php" class="btn btn-secondary btn-lg">Popular Questions</a>
    <?php endif; ?>
</div>

<div class="row mt-5">
    <div class="col-md-8">
        <h2>Latest Questions</h2>
        <?php
            $questions = getLatestQuestion($pdo);
            if (count($questions) > 0): ?>
            <div class="list-group">
                <?php foreach ($questions as $question): ?>
                    <a href="question.php?id=<?= $question['question_id'] ?>" class="list-group-item list-group-item-action shadow-lg">
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
            <div class="mt-3">
                <a href="questions.php" class="btn btn-primary shadow-lg">View All Questions</a>
            </div>
        <?php else: ?>
            <p>No questions have been asked yet. Be the first to ask!</p>
        <?php endif; ?>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Popular Modules
            </div>
            <div class="card-body">
                <?php
                $modules = getModulesAndQuestionCount($pdo);
                if (count($modules) > 0):
                ?>
                    <ul class="list-group">
                        <?php foreach ($modules as $module): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg">
                                <a href="questions.php?module=<?= $module['module_id'] ?>">
                                    <?= htmlspecialchars($module['module_name']) ?>
                                </a>
                                <span class="badge bg-primary rounded-pill"><?= $module['question_count'] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="card-text ">No modules available yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include './templates/footer.html.php'; ?>