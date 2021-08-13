<?php
require_once 'vendor/autoload.php';
 
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
//use app\api\CustomerController;
/**
 * 
 */
class Route
{
 
public function route(){


try
{


//Route::resource('customer', CustomerController::class);
    // Init basic route
    // $foo_route = new Route(
    //   '/foo',
    //   array('controller' => 'FooController')
    // );
    //   // Init basic route
    // $user_login = new Route(
    //   '/users/login',
    //   array('controller' => 'UserController::login')
    // );
 
    // // Init route with dynamic placeholders
    // $foo_placeholder_route = new Route(
    //   '/foo/{id}',
    //   array('controller' => 'FooController', 'method'=>'load'),
    //   array('id' => '[0-9]+')
    // );

     // Load routes from the yaml file
    $fileLocator = new FileLocator(array(__DIR__));
    $loader = new YamlFileLoader($fileLocator);
    $routes = $loader->load('routes.yaml');
 
    // Add Route object(s) to RouteCollection object
    // $routes = new RouteCollection();
    // $routes->add('foo_route', $foo_route);
    // $routes->add('user_login', $user_login);
    // $routes->add('foo_placeholder_route', $foo_placeholder_route);

 
    // Init RequestContext object
    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());
 
    // Init UrlMatcher object
    $matcher = new UrlMatcher($routes, $context);
 
    // Find the current route
    $parameters = $matcher->match($context->getPathInfo());
 
    // How to generate a SEO URL
    $generator = new UrlGenerator($routes, $context);
    $url = $generator->generate('foo_placeholder_route', array(
      'id' => 123,
    ));
 
    // echo '<pre>';
    // print_r($parameters);
    $id = $parameters['id'] ?? '';
    call_user_func($parameters['controller'],$id);
 
    // echo 'Generated URL: ' . $url;
    // exit;
}
catch (ResourceNotFoundException $e)
{
  echo $e->getMessage();
}
}
}