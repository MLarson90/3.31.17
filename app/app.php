<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_saloon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));

    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');

    $app->get("/stylist", function() use ($app) {
      return $app['twig']->render('stylist.html.twig');
    });
    $app->post("/stylist", function() use ($app){
      return $app['twig']->render('stylist.html.twig');
    });
});
    return $app;
 ?>
