<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=library';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands'=>brand::getAll()));
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores'=>Store::getAll()));
    });

    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand_id = $brand->getId();
        return $app['twig']->render('brand.html.twig', array('copies'=>$brand->getCopies(), 'brand' => $brand, 'stores' => $brand->getstores(), 'all_stores' => store::getAll()));
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = store::find($id);
        $store_id = $store->getId();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getbrands(), 'all_brands' => brand::getAll()));
    });

    $app->post("/brands", function() use ($app) {
        $new_brand = new Brand($_POST['title']);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array('brands'=>brand::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $new_store = new Store($_POST['store_name']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores'=>store::getAll()));
    });

    $app->post("/add_store", function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $brand->addstore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getstores(), 'all_stores' => store::getAll()));
    });

    $app->post("/add_brand", function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $store->addbrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getbrands(), 'all_brands' => brand::getAll()));
    });

    return $app;

?>
