<?php

/* Go to My Apps dashboard: https://developers.mercadolibre.com.ar/apps/home, and get the information you need in order to the following enviroment variables */

/* Your Application Id */
$appId = getenv('App_ID');

/* Your Secret Key */
$secretKey = getenv('Secret_Key');

/* The Redirect url */
$redirectURI = getenv('Redirect_URI');

/* The site id of the country where your application will work.
If you don't know your site_id go to our sites resources: https://api.mercadolibre.com/sites  */
$siteId = 'MLA';

/* Base de datos.
$DATABASE_URL = 'postgres://xjubydasnrqhgz:30500059e50b99a49091dc7c5629414026f4dc5127988245a6f8a668882d242a@ec2-54-225-121-235.compute-1.amazonaws.com:5432/d8dcgc3t7r73g4'


//////////////////////////////////////////////////////////////////////////////////////////////////////
//If you don't use Heroku use the next config

// $appId = 'App_ID';

// $secretKey = 'Secret_Key';

// $redirectURI = 'Redirect_URI';

// $siteId = 'MLB';
