<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();
    $app['debug'] = true;
    $server = 'mysql:host=localhost:8889;dbname=hair_saloon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
    });
    $app->get("/stylist", function() use ($app) {
      return $app['twig']->render('stylist.html.twig', array('steve' => Stylist::getAll()));
    });
    $app->get("/clients/{id}", function($id) use ($app){
      $clients = Client::findStylist($id);
      $stylist = Stylist::findId($id);
      return $app['twig']->render('clients.html.twig', array("beccy" => $clients, 'sarah' => $stylist));
    });
    $app->get("/clients{id}/edit", function($id) use ($app){
      $client = Client::find($id);
      return $app['twig']->render("clients_edit.html.twig", array('client' =>$client));
    });
    $app->post("/stylist", function() use ($app){
      $first = $_POST['first'];
      $last = $_POST['last'];
      $years = $_POST['years'];
      $new_stylist = new Stylist($first,$last,$years);
      $new_stylist->save();
      return $app['twig']->render('stylist.html.twig', array('steve' => Stylist::getAll()));
    });
    $app->post("/clients/{id}",function($id) use ($app){
      $first = $_POST['first'];
      $last = $_POST['last'];
      $stylist_id = $_POST['stylist_id'];
      $new_client = new Client($first, $last, $stylist_id);
      $stylist = Stylist::findId($id);
      $clients = Client::findStylist($id);
      $new_client->save();
      return $app['twig']->render('clients.html.twig', array("beccy" => $clients, 'sarah' => $stylist));
    });

    return $app;
 ?>
