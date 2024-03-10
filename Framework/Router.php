<?php

namespace Framework;

use App\Controllers\ErrorController;

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
  public function registerRouter($method, $uri, $action) {

    list($controller, $controllerMethod) = explode('@', $action);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod
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
  public function route($uri) {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    foreach($this->routes as $route) {

      // Split the current URI into segments
      $uriSegments = explode('/', trim($uri, '/'));

      // Split the route URI into segments
      $routeSegments = explode('/', trim($route['uri'], '/'));

      $match = true;

      // Check if the number of segment matches
      if(count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)) {
        $params = [];

        $match = true;

        for($i = 0; $i < count($uriSegments); $i++) {
          // If the uri's do not match and there is no param
          if($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
            $match = false;
            break;
          }

          // Check for the param and add to $param array
          if(preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
            $params[$matches[1]] = $uriSegments[$i];
          }
        }

        if($match) {
         // Extract controller controllerMehtod
          $controller = 'App\\Controllers\\' . $route['controller'];
          $controllerMethod = $route['controllerMethod'];

          // Instantiate the controller and call the method
          $controllerInstance = new $controller();
          $controllerInstance->$controllerMethod($params);

          return;
        }
      }

      // if($route['uri'] === $uri && $route['method'] === $requestMethod) {
      //   // require basePath('App/'.$route['controller']);
      //   // Extract controller controllerMehtod
      //   $controller = 'App\\Controllers\\' . $route['controller'];
      //   $controllerMethod = $route['controllerMethod'];

      //   // Instantiate the controller and call the method
      //   $controllerInstance = new $controller();
      //   $controllerInstance->$controllerMethod();

      //   return;
      // }
    }

    ErrorController::notFound();
  }
}

