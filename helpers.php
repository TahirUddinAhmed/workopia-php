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
function loadView($name) {
   $viewPath = basePath("views/{$name}.view.php");

   if(file_exists($viewPath)) {
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
   $partialPath = basePath("views/partials/{$name}.php");

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