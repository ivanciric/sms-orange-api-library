<?php

/*
|--------------------------------------------------------------------------
| Example of an API handler
|--------------------------------------------------------------------------
|
| An application needs to require the composer vendor autoload file.
| This is usually accomplished by putting the
| "require '../vendor/autoload.php';" code
| in the application's point of entry.
|
| 1. We instantiate the Dispatcher class by injecting the specific
| implementation of the Bookable contract (Cruise or Tour).
|
| 2. The parameters from the search form (the $_POST array, for simplicity)
| are passed to the corresponding method of the $dispatcher object.
|
| 3. Response is returned from the $dispatcher.
|
| 4. We render a view with the $dispatcher's response,
| and a dump, for reference.
|
*/

require 'helper.php';
require '../vendor/autoload.php';
require '../vendor/illuminate/support/Illuminate/Support/helpers.php';

use SmsOrange\Dispatcher;

if (!empty($_POST)) {

    $serviceName = $_POST['type'];
    $serviceClass = 'SmsOrange\\' . $serviceName;
    $bookingStep = $_POST['step'];
    $containerName = $_POST['container'];

    /*
    |--------------------------------------------------------------------------
    | API Token
    |--------------------------------------------------------------------------
    |
    | This is the API token given to you by the Orange Travel,
    | upon your registration. It is a combination of many
    | unique user specific parameters.
    |
    */
    $token = '84-5wxD3SmdDDRghaJmdaw83GDUPohCjbvFz'; //'130-ummtyxIAsJjJD6YpY9SXMorCysB1DwNYJ'; // 84-5wxD3SmdDDRghaJmdaw83GDUPohCjbvFz

    $dispatcher = new Dispatcher(new $serviceClass($token));

    if($bookingStep == 'getComponents'){
        setcookie('cruise-guests', json_encode($_POST['guests']));
    }

    /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    |
    | We get the API response trough the Unirest library.
    |
    | Available properties are:
    |
    | $response->code      --  HTTP Status code
    | $response->headers   --  Headers
    | $response->body      --  Parsed body
    | $response->raw_body  --  Unparsed body
    |
    | For the purpose of demonstration, we will use $response->body in this example,
    | although you could preferably use 'raw_body' and deal with the plain JSON instead
    | trough javascript/AJAX, for a better UX.
    |
    */
    $response = $dispatcher->$bookingStep($_POST);

    $dump = is_object($response->body) ? $response->body : $response->body[0];

    $output = [
        'result' => loadView("$serviceName/{$_POST['webservice']}/$bookingStep.php", $response->body, $containerName),
        'dump' => varDumpToString($dump),
    ];

    exit(json_encode($output));
}
