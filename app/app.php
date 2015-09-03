<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost:3306;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
    
    //Path to home page:
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    //Path to all brands:
    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands'=>brand::getAll()));
    });

    //Path to all stores:
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores'=>Store::getAll()));
    });

    //Path to specific brand:
    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand_id = $brand->getId();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getstores(), 'all_stores' => store::getAll()));
    });

    //Path to specific store:
    $app->get("/store/{id}", function($id) use ($app) {
        $store = store::find($id);
        $store_id = $store->getId();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getbrands(), 'all_brands' => brand::getAll()));
    });

    //Path to list of all brands:
    $app->post("/brands", function() use ($app) {
        $new_brand = new Brand($_POST['brand_name']);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array('brands'=>brand::getAll()));
    });

    //Path to list of all stores:
    $app->post("/stores", function() use ($app) {
        $new_store = new Store($_POST['store_name']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores'=>store::getAll()));
    });

    //Path to add a store:
    $app->post("/add_store", function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $brand->addstore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getstores(), 'all_stores' => store::getAll()));
    });

    //Delete a single store:
      $app->delete('/store/{id}/edit', function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();return $app['twig']->render('index.html.twig', array ('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //Update a store
    $app->get("/stores/{id}/edit", function($id) use($app){
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store));
        });

    //Update a store:
    $app->patch("/stores/{id}", function($id) use($app){
        $store_name = $_POST['store_name'];
        $store = Store::find($id);
        $store->updateStoreName($store_name);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //Delete all stores, renders index:
    $app->post('/delete_stores', function () use ($app) {
        Store::deleteAll(); 
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),'brands' => Brand::getAll()));
    });


    //Path to add a brand:
    $app->post('/add_brand', function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $store->addbrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getbrands(), 'all_brands' => brand::getAll()));
    });

    //Delete all brands, renders index:
    $app->post('/delete_brands', function () use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });
    
    return $app;

?>
