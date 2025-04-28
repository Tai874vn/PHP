<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Your Answer</h5>
    </div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">                
            <div class="mb-3">
                <textarea class="form-control" name="content" id="content" rows="5"></textarea>
            </div>               
            <button type="submit" class="btn btn-primary">Post Your Answer</button>
        </form>
    </div>
</div>
