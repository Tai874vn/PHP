<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include  './includes/databaseConnection.php';


function getModulesAndQuestionCount($pdo) {
    $stmt = $pdo->query('
        SELECT m.module_id, m.module_name, COUNT(q.question_id) as question_count
        FROM modules m
        LEFT JOIN questions q ON m.module_id = q.module_id
        GROUP BY m.module_id
        ORDER BY question_count DESC
    ');
    return $stmt->fetchAll();
}

function getLatestQuestion($pdo) {
    $stmt = $pdo->query('
        SELECT q.*, u.username, m.module_name
        FROM questions q
        LEFT JOIN users u ON q.user_id = u.user_id
        LEFT JOIN modules m ON q.module_id = m.module_id
        ORDER BY q.created_at DESC
        LIMIT 8
        ');
    return $stmt->fetchAll();
}

function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        return true;
    }
    return false;
}

function registerUser($pdo, $username, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        return "Username already registered.";
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return "Email already registered.";
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $hashedPassword]) ? "Registration complete!" : "Registration failed. Please try again.";
}



function updateUser($pdo, $username, $email, $password, $user_id){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?");
    return $stmt->execute([$username, $email, $hashedPassword, $user_id]);
}


function deleteUser($pdo,$user_id){
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
}



function getAllModules($pdo){
    $stmt = $pdo->query("SELECT * FROM modules ORDER BY module_id");
    return $stmt->fetchAll();   
}


function insertQuestion($pdo, $title, $content, $imageData, $userId, $moduleId) {
    try {
        $stmt = $pdo->prepare('
            INSERT INTO questions (title, content, image, user_id, module_id) VALUES (?, ?, ?, ?, ?)
        ');
        $stmt->execute([$title, $content, $imageData, $userId, $moduleId]);
        return $pdo->lastInsertId(); 
    } catch (PDOException $e) {
        return false; 
    }
}

function getQuestion($pdo, $question_id) {
    $stmt = $pdo->prepare("SELECT * FROM questions WHERE question_id = ?");
    $stmt->execute([$question_id]);
    return $stmt->fetch();
}


function updateQuestion($pdo, $title, $content, $image, $module_id, $question_id) {
    try {
        $stmt = $pdo->prepare('
            UPDATE questions 
            SET title = ?, content = ?, image = ?, module_id = ?, updated_at = NOW()
            WHERE question_id = ?
        ');
        $stmt->execute([$title, $content, $image, $module_id, $question_id]);
    } catch (PDOException $e) {
        return false; 
    }
}

function getAnswers($pdo,$question_id){
    $stmt = $pdo->prepare('
        SELECT 
        a.answer_id AS answer_id,
        a.content AS content,
        a.user_id AS user_id,
        a.created_at AS created_at,
        u.username AS username
        FROM answers a
        LEFT JOIN users u ON a.user_id = u.user_id
        WHERE a.question_id = ?
        ORDER BY a.created_at DESC
    ');
    $stmt->execute([$question_id]);
    return $stmt->fetchAll();
}

function insertAnswer($pdo, $content, $user_id, $question_id, $created_at){
    $stmt = $pdo->prepare('
        INSERT INTO answers (content, user_id, question_id, created_at) VALUES (?, ?, ?, ?)
    ');
    $stmt->execute([$content, $user_id, $question_id, $created_at]);
}


function authorizeUserAnswer($pdo, $answerId){
    $stmt = $pdo->prepare('
        SELECT user_id, question_id FROM answers 
        WHERE answer_id = ?
    ');
    $stmt->execute([$answerId]);
    return $stmt->fetch();
}

function deleteAnswer($pdo, $answerId, $user_id){
    $stmt = $pdo->prepare('
        DELETE FROM answers 
        WHERE answer_id = ? AND user_id = ?
    ');
    $stmt->execute([$answerId, $user_id]);
}

function getQuestionDetail($pdo,$question_id){
    $stmt = $pdo->prepare('
        SELECT q.*, u.username, m.module_name
        FROM questions q
        LEFT JOIN users u ON q.user_id = u.user_id
        LEFT JOIN modules m ON q.module_id = m.module_id
        WHERE q.question_id = ?
    ');
$stmt->execute([$question_id]);
return $stmt->fetch();
}

function deleteQuestion($pdo,$question_id){
    $stmt = $pdo->prepare('DELETE FROM questions WHERE question_id = ?');
    $stmt->execute([$question_id]);
}


function searchQuestions($pdo, $searchTitle) {
    $stmt = $pdo->prepare('
        SELECT q.*, u.username, m.module_name
        FROM questions q
        LEFT JOIN users u ON q.user_id = u.user_id
        LEFT JOIN modules m ON q.module_id = m.module_id
        WHERE q.title LIKE :search
        ORDER BY question_id
    ');
    $stmt->execute(['search' => '%' . $searchTitle . '%']);
    return $stmt->fetchAll();
}

function getAllQuestion($pdo){
    $stmt = $pdo->query('
        SELECT q.*, u.username, m.module_name
        FROM questions q
        LEFT JOIN users u ON q.user_id = u.user_id
        LEFT JOIN modules m ON q.module_id = m.module_id
        ORDER BY question_id
    ');
return $stmt->fetchAll();  
}


function getUsers($pdo){
    $stmt = $pdo->query('SELECT * FROM users');
    return $stmt->fetchAll();
}


function updateQuestionAndModule($pdo, $user_id, $module_id, $question_id) {
    $stmt = $pdo->prepare("UPDATE questions SET user_id = ?, module_id = ? WHERE question_id = ?");
    $stmt->execute([$user_id, $module_id, $question_id]);
}

function updateAnswer($pdo, $answerId, $content){
    $stmt = $pdo->prepare("UPDATE answers SET content = ? WHERE answer_id = ?");
    $stmt->execute([$content, $answerId]);
}

function logoutUser() {
    session_destroy();
    header("Location: login.php");
    exit;
}

function addModule($pdo,$module_name) {
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE module_name = ?");
    $stmt->execute([$module_name]);
    if ($stmt->fetch()) {
        return "Module name already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO modules (module_name) VALUES (?)");
        $stmt->execute([$module_name]);
        return "New module added";
    }
}

function editModule($pdo,$module_name,$module_id){
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE module_name = ?");
    $stmt->execute([$module_name]);
    if ($stmt->fetch()) {
        return "Module name already exists.";
    } else {
        $stmt = $pdo->prepare("UPDATE modules SET module_name = ? WHERE module_id = ?");
        $stmt->execute([$module_name,$module_id]);
        return "Module name changed";
    }
}

function deleteModule($pdo,$module_id){
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM questions WHERE module_id = ?");
    $stmt->execute([$module_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return "Cannot delete module: there are questions assigned to it.";
    } else {
        $stmt = $pdo->prepare("DELETE FROM modules WHERE module_id = ?");
        $stmt->execute([$module_id]);
        return "Module deleted.";
    }
}

function updatePassword($pdo, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $result = $stmt->execute([$hashedPassword, $email]);
    return $result ? "Password changed!" : "Failed to change password";
}
?>