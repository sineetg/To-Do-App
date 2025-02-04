<?php
include 'todo.php'; // Including the PHP logic

// Check if a task is being added
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $tasks = loadTasks();
    $tasks[] = ["task" => $_POST['task'], "done" => false];
    saveTasks($tasks);
    header("Location: index.php"); // Redirect to avoid form resubmission
    exit;
}

// Check if a task is marked as done
if (isset($_GET['done'])) {
    $tasks = loadTasks();
    $tasks[$_GET['done']]['done'] = true;
    saveTasks($tasks);
    header("Location: index.php");
    exit;
}

// Check if a task is deleted
if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    $tasks = loadTasks();
    if (isset($tasks[$index])) {
        array_splice($tasks, $index, 1);
        saveTasks($tasks);
    }
    header("Location: index.php"); // Redirect after deletion
    exit;
}

$tasks = loadTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <?php include 'bootstrap.php'; ?> <!-- Including Bootstrap -->
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">To-Do List</h2>
    <form method="POST" action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="task" placeholder="Enter a task" required>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </div>
    </form>
    
    <ul class="list-group">
        <?php foreach ($tasks as $index => $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="<?php echo $task['done'] ? 'text-decoration-line-through' : ''; ?>">
                    <?php echo htmlspecialchars($task['task']); ?>
                </span>
                <div>
                    <a href="?done=<?php echo $index; ?>" class="btn btn-success btn-sm">Done</a>
                    <a href="?delete=<?php echo $index; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'footer.php'; ?> <!-- Including footer if necessary -->
</body>
</html>
