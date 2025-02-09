<?php

switch ($_REQUEST['slug']) {
    case 'lac-des-eaux-bleues-ein-juwel-in-der-naehe-von-lyon':
        redirectSingle('https://freudefoto.de/single/lac-des-eaux-bleues-ein-juwel-in-der-naehe-von-lyon');
        break;
    case 'alte-fabrik-am-kanal-unter-nebligem-himmel-in-deluxe':
        redirectSingle('https://freudefoto.de/single/alte-fabrik-am-kanal-unter-nebligem-himmel-in-deluxe');
        break;
    case 'piscine-du-rhone-in-lyon':
        redirectSingle('https://freudefoto.de/single/die-piscine-du-rhone-ein-freibad-am-ufer-der-rhone-in-lyon');
        break;

    case 'naturpark-narbonnaise-en-mediterranee':
        redirectSingle('https://freudefoto.de/single/naturpark-narbonnaise-en-mediterranee');
        break;

    case 'avenue-louis-faedda-in-le-lavandou':
        redirectSingle('https://freudefoto.de/single/avenue-louis-faedda-in-le-lavandou');
        break;
    default:
        if(empty($_REQUEST['slug'])) {
            redirectSingle('https://freudefoto.de');
        }
        redirectSingle('https://freudefoto.de/single/'.$_REQUEST['slug']);
        break;
}


function redirectSingle($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
