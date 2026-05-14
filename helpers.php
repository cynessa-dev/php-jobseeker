<?php

/**
 * Get the path
 * @param string $path
 * @return string
 */
function basePath($path = "") {
    return __DIR__ . "/" . $path;
}

/**
 * Load view
 * @param string $name
 * @param array $data
 * @return void
 */
function loadView($name, $data = []) {
    $viewPath = basePath("views/{$name}.view.php");

    // Ensures that the path exist before loading
    if (file_exists($viewPath)) {
        extract($data); // Extracts the data array into variables for use in the view
        require $viewPath;
    } else {
        echo "View not found: {$name}";
    }
}

/**
 * Load partial
 * @param string $name
 * @return null
 */
function loadPartial($name) {
    $partialPath = basePath("views/partials/{$name}.php");

    // Ensures that the path exist before loading
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial not found: {$name}";
    }

    return null;
}

?>