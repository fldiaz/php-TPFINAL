<?php
session_start();
require 'Meli/meli.php';
require 'configApp.php';
$domain = $_SERVER['HTTP_HOST'];
$appName = explode('.', $domain)[0];
?>

    <!DOCTYPE html>
    <html lang="en" class="no-js">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="Official PHP SDK for Mercado Libre's API.">
        <meta name="keywords" content="API, PHP, Mercado Libre, SDK, meli, integration, e-commerce">
        <title>Mercado Libre PHP SDK</title>
        <link rel="stylesheet" href="/getting-started/style.css" />
        <script src="script.js"></script>
    </head>

    <body>
        <header class="navbar">
            <a class="logo" href="#"><img src="/getting-started/logo-developers.png" alt=""></a>
            <nav>
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="https://www.linkedin.com/in/fldiaz/">Sobre mi</a></li>
                    <li><a target="_blank" href="http://developers.mercadolibre.com/api-docs/">Sobre mi Trabajo Final</a></li>
                    <li><a target="_blank" href="http://developers.mercadolibre.com/community/">Community</a></li>
                </ul>
            </nav>
        </header>

        <div class="header">
            <div>
                <h1>Uso de información alternativa en la evaluación del perfil crediticio mediante modelos de aprendizaje automáticos</h1>
                <h2>TRABAJO FINAL</h2>
                <h2>ESPECIALIZACIÓN EN CIENCIA DE DATOS</h2>
                <p>Alumna: Lic. Florencia Díaz</p>
                <p>Tutora del TFI: Dra. Silvia Gómez</p>

            </div>
        </div>

        <main class="container">
            <h4>Hola! En primer lugar, muchas gracias por ayudarme.</h4>
            <h4>Estoy realizando el trabajo final de la Especialización en Ciencia de Datos en el ITBA.</h4>
            <h4>Este trabajo tiene como objetivo identificar otras variables informativas que permitan mejorar o complementar el perfil crediticio de las personas que no acceden a servicios financieros formales, en pos de una mayor inclusión financiera.</h4>
            <h4>Simplemente necesito que me brindes autorización para recopilar tus datos relacionados con tu reputación sobre las compras y ventas realizdas a través de Mercado Libre, y así poder comprobar si esta información ayuda a mejorar el perfil crediticio de un individuo</h4>
                el perfil crediticio de un individuo.</h4>
        
        <center>SOLO TENDRE ACCESO POR 6 HORAS, LUEGO EL PERMISO CADUCA</center>

            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h3>Autorización</h3>
                    <p></p>

                    <?php
                    $meli = new Meli($appId, $secretKey);
                    if($_GET['code'] || $_SESSION['access_token']) {
                        // If code exist and session is empty
                        if($_GET['code'] && !($_SESSION['access_token'])) {
                            // If the code was in get parameter we authorize
                            $user = $meli->authorize($_GET['code'], $redirectURI);
                            // Now we create the sessions with the authenticated user
                            $_SESSION['access_token'] = $user['body']->access_token;
                            $_SESSION['expires_in'] = time() + $user['body']->expires_in;
                            $_SESSION['refresh_token'] = $user['body']->refresh_token;
                        } else {
                            // We can check if the access token in invalid checking the time
                            if($_SESSION['expires_in'] < time()) {
                                try {
                                    // Make the refresh proccess
                                    $refresh = $meli->refreshAccessToken();
                                    // Now we create the sessions with the new parameters
                                    $_SESSION['access_token'] = $refresh['body']->access_token;
                                    $_SESSION['expires_in'] = time() + $refresh['body']->expires_in;
                                    $_SESSION['refresh_token'] = $refresh['body']->refresh_token;
                                } catch (Exception $e) {
                                    echo "Exception: ",  $e->getMessage(), "\n";
                                }
                            }
                        }
                        echo '<pre>';
                            print_r($_SESSION);
                        echo '</pre>';
                    } else {
                        echo '<p><a alt="Login using MercadoLibre oAuth 2.0" class="btn" href="' . $meli->getAuthUrl($redirectURI, Meli::$AUTH_URL[$siteId]) . '">Authenticate</a></p>';
                    }
                    ?>

                </div>
            </div>
            <hr>
                    <?php
                    $meli = new Meli($appId, $secretKey);
                    if($_GET['code']) {
                        // If the code was in get parameter we authorize
                        $user = $meli->authorize($_GET['code'], $redirectURI);
                        // Now we create the sessions with the authenticated user
                        $_SESSION['access_token'] = $user['body']->access_token;
                        $_SESSION['expires_in'] = $user['body']->expires_in;
                        $_SESSION['refresh_token'] = $user['body']->refresh_token;
                        // We can check if the access token in invalid checking the time
                        if($_SESSION['expires_in'] + time() + 1 < time()) {
                            try {
                                print_r($meli->refreshAccessToken());
                            } catch (Exception $e) {
                                echo "Exception: ",  $e->getMessage(), "\n";
                            }
                        }
                        // We construct the item to POST
                        $params = 202593498;
                        $url = '/sites/' . $siteId;
                        $response = $meli->get('/users', $params, array('access_token' => $_SESSION['access_token']));
                        // We call the post request to list a item
                        echo '<pre>';
                        print_r($response);
                        echo '</pre>';
                
                  } else if($_GET['code']) {
                        echo '<p><a alt="Publish Item" class="btn" href="/?code='.$_GET['code'].'&publish_item=ok">Publish Item</a></p>';
                  } else {
                        echo '<p><a alt="Publish Item" class="btn disable" href="#">Publish Item</a> </p>';
                    }
                    ?>

                </div>

                <div class="col-md-6">
                    <h3>Get started!</h3>
                    <p>Now you know how easy it is to get information from our API. Check the rest of the examples on the SDK, and modify them as you like in order to List an item, update it, and other actions.</p>
                    <p><a class="btn" href="https://github.com/mercadolibre/php-sdk/tree/master/examples">More examples</a></p>
                </div>
            </div>

            <hr>

            <div class="row">
                <h3>Your Credentials</h3>
                <div class="row-info col-sm-3 col-md-3">
                    <b>App_Id: </b>
                    <?php echo $appId; ?>
                </div>
                <div class="row-info col-sm-3 col-md-3">
                    <b>Secret_Key: </b>
                    <?php echo $secretKey; ?>
                </div>
                <div class="row-info col-sm-3 col-md-3">
                    <b>Redirect_URI: </b>
                    <?php echo $redirectURI; ?>
                </div>
                <div class="row-info col-sm-3 col-md-3">
                    <b>Site_Id: </b>
                    <?php echo $siteId; ?>
                </div>
            </div>
            <hr>
        </main>
    </body>

    </html>
