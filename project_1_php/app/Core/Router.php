<?php 

namespace App\Core;

use App\Middlewares\AuthMiddleware;

class Router{
    private array $routes = [];

    public function get($path, $handler, array $middlewares = []) {
        $this->routes['GET'][] = compact('path', 'handler', 'middlewares');
    }

    public function post($path, $handler, array $middlewares = []) {
        $this->routes['POST'][] = compact('path', 'handler', 'middlewares');
    }

    public function put($path, $handler, array $middlewares = []) {
        $this->routes['PUT'][] = compact('path', 'handler', 'middlewares');
    }

    public function delete($path, $handler, array $middlewares = []) {
        $this->routes['DELETE'][] = compact('path', 'handler', 'middlewares');
    }

    public function dispatch($url, $method){
        $basePath = '/skiff_task/project_1_php';
        $url = parse_url($url, PHP_URL_PATH);
        $path = str_replace($basePath, '', $url);

        $path = $path === '' ? '/' : $path;

        foreach ($this->routes[$method] ?? [] as $route) {
            $pattern = preg_replace('#\{([^}]+)\}#', '(?P<$1>[^/]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $path, $matches)) {
                // Middleware 
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareClass = "App\\Middlewares\\$middleware";
                    if (!class_exists($middlewareClass)) {
                        http_response_code(500);
                        echo json_encode(['error' => "Middleware $middlewareClass not found"]);
                        exit;
                    }
                    $result = (new $middlewareClass())->handle();
                    if ($result === null) exit; 
                }

                // Controller and Method 
                [$controllerName, $methodName] = explode('@', $route['handler']);
                $controllerName = str_replace('/', '\\', $controllerName);
                $controllerClass = "App\\Controllers\\$controllerName";

                if (!class_exists($controllerClass)) {
                    http_response_code(500);
                    echo json_encode(['error' => "Controller $controllerClass not found"]);
                    exit;
                }

                $controller = new $controllerClass();

                if (!method_exists($controller, $methodName)) {
                    http_response_code(500);
                    echo json_encode(['error' => "Method $methodName not found in controller $controllerClass"]);
                    exit;
                }

                // Filter
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $response = call_user_func_array([$controller, $methodName], $params);

                if($controllerName != 'Api\ApiDocumentController'){
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }else{
                    return;
                }
               
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}