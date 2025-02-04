<?php
$file = 'todo.json'; // File where tasks are stored

// Load tasks from the JSON file
function loadTasks() {
    global $file;
    // Check if the file exists
    if (!file_exists($file)) {
        // Create an empty file if it doesn't exist
        file_put_contents($file, json_encode([])); // Initializing with an empty array
    }
    return json_decode(file_get_contents($file), true);
}

// Save tasks to the JSON file
function saveTasks($tasks) {
    global $file;
    file_put_contents($file, json_encode($tasks, JSON_PRETTY_PRINT));
}
?>
