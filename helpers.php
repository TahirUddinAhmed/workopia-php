<?php

/**
 * Get the base path
 * @param string $path
 * @return string
 */
function basePath($path = '') {
   return __DIR__ . '/' . $path;
}

/**
 * Load a view 
 * @param string $name
 * @return void
 */
function loadView($name, $data = []) {
   $viewPath = basePath("App/views/{$name}.view.php");

   if(file_exists($viewPath)) {
      extract($data);
      require $viewPath;
   } else {
      echo "View {$viewPath} not found";
   }
}

/**
 * Load a partials
 * @param string $name
 * @return void
 */
function loadPartial($name) {
   $partialPath = basePath("App/views/partials/{$name}.php");

   if(file_exists($partialPath)) {
      require $partialPath;
   } else {
      echo "Partials {$partialPath} not found";
   }
}

/**
 * Inspact a value(s)
 * @param mixed $value
 * @return void
 */
function inspact($value) {
   echo "<pre>";
   var_dump($value);
   echo "</pre>";
}

/**
 * Inspact a value and die
 * @param mixed $value
 * @return void
 */
function inspactAndDie($value) {
   echo "<pre>";
   var_dump($value);
   echo "</pre>";
   die();
}

/**
 * Formate salary
 * 
 * @param string $salary
 * @return string FormattedSalary
 */
function formatSalary($salary) {
   return '$' . number_format(floatVal($salary));
}

/**
 * Sanitize data
 * 
 * @param string $dirty
 * @return string
 */
function sanitize($dirty) {
   return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}