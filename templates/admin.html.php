<?php include './templates/header.html.php'; ?>
<div class="container py-4">
    <h1 class="mb-4">Admin Panel</h1>
    <!-- error -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <!-- tablist -->
    <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
        <!-- Users tab -->
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">
                Manage Users
            </button>
        </li>
        <!-- Questions tab -->
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="questions-tab" data-bs-toggle="tab" data-bs-target="#questions" type="button" role="tab" aria-controls="questions" aria-selected="false">
                Manage Questions
            </button>
        </li>
        <!-- Modules tab -->
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="modules-tab" data-bs-toggle="tab" data-bs-target="#modules" type="button" role="tab" aria-controls="modules" aria-selected="false">
                Manage Modules
            </button>
        </li>
    </ul>
    <!-- tab content -->
    <div class="tab-content" id="adminTabsContent">
        <!-- Users Tab -->
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="card">
                <div class="card-header bg-primary text-white">
                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                    <span>User Management</span>
                    <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Admin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['user_id']) ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <?php if ($user['role'] === 'admin' ):  ?>
                                            <span class="badge bg-success">Yes</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $user['user_id'] ?>">
                                            Edit
                                        </button>

                                        <!-- Edit User Modal -->
                                        <div class="modal fade" id="editUserModal<?= $user['user_id'] ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?= $user['user_id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form method="post">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="editUserModalLabel<?= $user['user_id'] ?>">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                                <div class="mb-3">
                                                    <label for="username<?= $user['user_id'] ?>" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username<?= $user['user_id'] ?>" name="username" value="<?= $user['username'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email<?= $user['user_id'] ?>" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email<?= $user['user_id'] ?>" name="email" value="<?= $user['email'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password<?= $user['user_id'] ?>" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password<?= $user['user_id'] ?>" name="password">
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="edit_user" value="<?= $user['user_id'] ?>" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <button type="submit" name="delete_user" class="btn btn-outline-danger" value="<?= $user['user_id'] ?>">Delete</button>
                                            </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Questions Tab -->
        <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="questions-tab">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-question-circle me-2"></i>Question Assignment</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Assigned To</th>
                                    <th>Module</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($questions as $question): ?>
                                <tr>
                                    <td><?= htmlspecialchars($question['question_id']) ?></td>
                                    <td><?= htmlspecialchars($question['title']) ?></td>
                                    <td>
                                        <?= $question['username'] ? htmlspecialchars($question['username']) : '<span class="text-muted">Unassigned</span>' ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $moduleName = 'Unassigned';
                                        foreach ($modules as $module) {
                                            if ($module['module_id'] == $question['module_id']) {
                                                $moduleName = $module['module_name'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($moduleName);
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal<?= $question['question_id'] ?>">
                                            Assign
                                        </button>
                                        
                                        <!-- Assign Question Modal -->
                                        <div class="modal fade" id="assignModal<?= $question['question_id'] ?>" tabindex="-1" aria-labelledby="assignModalLabel<?= $question['question_id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="assignModalLabel<?= $question['question_id'] ?>">Assign Question</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                        <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
                                                        <div class="modal-body">
                                                            
                                                            <div class="mb-3">
                                                                <label for="questionTitle<?= $question['question_id'] ?>" class="form-label">Question Title:</label>
                                                                <input type="text" class="form-control" id="questionTitle<?= $question['question_id'] ?>" value="<?= htmlspecialchars($question['title']) ?>" readonly>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="userSelect<?= $question['question_id'] ?>" class="form-label">Assign to User:</label>
                                                                <select class="form-select" id="userSelect<?= $question['question_id'] ?>" name="user_id">
                                                                    <option value="">-- Unassign --</option>
                                                                    <?php foreach ($users as $user): ?>
                                                                    <option value="<?= $user['user_id'] ?>" <?= ($user['user_id'] == $question['user_id']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($user['username']) ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="moduleSelect<?= $question['question_id'] ?>" class="form-label">Assign to Module:</label>
                                                                <select class="form-select" id="moduleSelect<?= $question['question_id'] ?>" name="module_id">
                                                                    <option value="">-- No Module --</option>
                                                                    <?php foreach ($modules as $module): ?>
                                                                    <option value="<?= $module['module_id'] ?>" <?= ($module['module_id'] == $question['module_id']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($module['module_name']) ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="assign_question" class="btn btn-primary">Save Assignment</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modules Tab -->
        <div class="tab-pane fade" id="modules" role="tabpanel" aria-labelledby="modules-tab">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Module Management</h5>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addModuleModal">Add Module</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Module Name</th>
                                    <th>Questions Assigned</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($modules as $module): ?>
                                <tr>
                                    <td><?= htmlspecialchars($module['module_id']) ?></td>
                                    <td><?= htmlspecialchars($module['module_name']) ?></td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            <?php 
                                            $hasQuestion = false;
                                            foreach ($questions as $question) {
                                                if ($question['module_id'] == $module['module_id']) {
                                                    $hasQuestion = true;
                                                    echo "<li>" . htmlspecialchars($question['title']) . " <span class='text-muted'>(" . htmlspecialchars($question['question_id']) . ")</span></li>";
                                                }
                                            }
                                            if (!$hasQuestion) {
                                                echo "<li class='text-muted'>No questions</li>";
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editModuleModal<?= $module['module_id'] ?>">
                                            Edit
                                        </button>

                                        <!-- Delete Module Modal -->
                                        <form method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this module?');">
                                            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
                                            <button type="submit" name="delete_module" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                        
                                        <!-- Edit Module Modal -->
                                        <div class="modal fade" id="editModuleModal<?= $module['module_id'] ?>" tabindex="-1" aria-labelledby="editModuleModalLabel<?= $module['module_id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="editModuleModalLabel<?= $module['module_id'] ?>">Edit Module</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="module_name<?= $module['module_id'] ?>">Module Name</label>
                                                                <input type="text" class="form-control" id="module_name<?= $module['module_id'] ?>" name="edit_module_name" value="<?= htmlspecialchars($module['module_name']) ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="edit_module" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="newUsername" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="newEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="newEmail" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="newPassword" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="newConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="newConfirmPassword" name="newConfirmPassword">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Module Modal -->
        <div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addModuleModalLabel">Add New Module</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="new_module_name" class="form-label">Module Name</label>
                                <input type="text" class="form-control" id="new_module_name" name="module_name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_module" class="btn btn-primary">Add Module</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './templates/footer.html.php';?>