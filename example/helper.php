<?php

/*
|--------------------------------------------------------------------------
| Helper functions used in the API example application
|--------------------------------------------------------------------------
*/

/**
 * Renders and returns the requested view.
 *
 * @param string $strViewPath
 * @param array $arrayOfData
 * @param string $containerName name of the variable holding the data in the view
 * @return string rendered view
 */
function loadView($strViewPath, $arrayOfData, $containerName)
{
    extract($arrayOfData);

    $$containerName = $arrayOfData;

    $num = count($$containerName);

    ob_start();
    require(__DIR__ . '/partials/' . $strViewPath);
    $strView = ob_get_contents();
    ob_end_clean();

    return $strView;
}

/**
 * Renders the var_dump() output as view.
 *
 * @param array|object $mixed
 * @return string contents of var_dump()
 */
function varDumpToString($mixed = null)
{
    ob_start();
    var_dump($mixed);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
