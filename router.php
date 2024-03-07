<?php
// return [
//     '/' => 'controllers/home.php',
//     '/listings' => 'controllers/listings/index.php',
//     '/listings/create' => 'controllers/listings/create.php',
//     '404' => 'controllers/error/404.php'
// ];

class Router {
  protected $routes = [];


  /**
   * Add a new route
   *
   * @param string $method
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function registerRouter($method, $uri, $controller) {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller
    ];
  }

  /**
   * Add a GET route
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function get($uri, $controller) {
    $this->registerRouter('GET', $uri, $controller);
  }

  /**
   * Add a POST route 
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function post($uri, $controller) {
    $this->registerRouter('POST', $uri, $controller);
  }

  /**
   * Add a PUT route 
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function put($uri, $controller) {
    $this->registerRouter('PUT', $uri, $controller);
  }

  /**
   * Add a DELETE route 
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function delete($uri, $controller) {
    $this->registerRouter('DELETE', $uri, $controller);
  }

  /**
   * load error Page
   * @param int $httpCode
   * @return void
   */
  public function error($httpCode=404) {
    http_response_code($httpCode);
    loadView("error/{$httpCode}");
    exit();
  }

  /**
   * Route the request 
   * 
   * @param string $uri
   * @param string $method
   * @return void
   */
  public function route($uri, $method) {
    foreach($this->routes as $route) {
      if($route['uri'] === $uri && $route['method'] === $method) {
        require basePath($route['controller']);
        return;
      }
    }

    $this->error();
  }
}

