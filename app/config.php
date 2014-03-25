<?php
include_once 'vars.inc.php';
include_once 'arrays.php';
include_once LANGS_FOLDER.'lang.common.php';

$app = new \Slim\Slim();
if(COOKIES_ENABLED) {
  $app->add(new \Slim\Middleware\SessionCookie(array(
    'secret'  => md5(COOKIE_SECRET),
    'expires' => COOKIE_DURATION,
    'name'    => COOKIE_NAME
  )));
}

$app->config(array(
  'templates.path' => VIEWS_FOLDER,
  'view'           => new \Slim\Views\Twig(array('debug' => true))
));

$app->configureMode('production', function () use ($app) {
  $app->config(array('log.enabled' => true, 'debug' => false));
});

$app->configureMode('development', function () use ($app) {
  $app->config(array('log.enabled' => false, 'debug' => true));
});

$app->notFound(function () use ($app) { $app->render('404.twig'); });

//Language
$langCookie = COOKIE_PREFIX.'.lang';
$selectedLang = $app->getCookie($langCookie);
$selectedLangPath = LANGS_FOLDER.'lang.'.$selectedLang.'.php';
$defaultLang = $lang->langs[0];
$defaultLangPath = LANGS_FOLDER.'lang.'.$defaultLang['suffix'].'.php';

if($selectedLang == null){
  include_once $defaultLangPath;
} else {
  include_once $defaultLangPath;
  if(file_exists($selectedLangPath)){
    include_once $selectedLangPath;
  }
}
$app->lang = $lang;

$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$resourceUri = $_SERVER['REQUEST_URI'];

$view = $app->view();
$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new Twig_Extension_Debug()
);
$app->view()->appendData(array(
  'title' => TITLE,
  'app' => $app,
  'root' => $rootUri,
  'assetUri' => $assetUri,
  'activeUrl' => $resourceUri,
  'css'  => CSS_FOLDER,
  'js'   => JS_FOLDER,
  'img'  => IMG_FOLDER,
  'lang' => $lang,
  'langCookie' => $langCookie
));

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection(array(
  'driver'    => DB_DRIVER,
  'host'      => DB_HOST,
  'database'  => DB_DATABASE,
  'username'  => DB_USERNAME,
  'password'  => DB_PASSWORD,
  'prefix'    => DB_PREFIX,
  'charset'   => DB_CHARSET,
  'collation' => DB_COLLATION,
));
$capsule->bootEloquent();
$capsule->setAsGlobal();
$app->db = $capsule->connection();
?>
