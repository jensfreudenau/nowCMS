<?php



/***************************************************
 * Only these origins are allowed to upload images *
 ***************************************************/
$accepted_origins = [
    'http://localhost',
    'https://freudefoto.local',
    'https://berlinerphotoblog.local',
    'https://freude-now.de',
    'https://www.freude-now.de',
    'https://berlinerphotoblog.de',
    'https://www.berlinerphotoblog.de',
];



    $imageFolder = 'images/';


// Don't attempt to process the upload on an OPTIONS request
//if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//    header("Access-Control-Allow-Methods: POST, OPTIONS");
//    return;
//}

reset($_FILES);
$temp = current($_FILES);
if (is_uploaded_file($temp['tmp_name'])) {
    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    // header('Access-Control-Allow-Credentials: true');
    // header('P3P: CP="There is no P3P policy."');

    // Sanitize input
//    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
//        header("HTTP/1.1 400 Invalid file name.");
//        return;
//    }

    // Verify extension
//    if (!in_array(
//        strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)),
//        array('webp')
//    )) {
//        header("HTTP/1.1 404 Invalid extension.");
//        return;
//    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];

    move_uploaded_file($temp['tmp_name'], $filetowrite);

    // Determine the base URL
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
    $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";

    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    //echo json_encode(array('location' => $temp['name']));
//    $mysql->insertMediathek($temp['name']);
//    makeThumb($filetowrite, $imageFolder. '/thumbnails/'.$temp['name'], 400);
    echo json_encode(array('location' => $temp['name']));
} else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
}
function makeThumb($src, $dest, $desiredWidth)
{
//    /* read the source image */
//    $sourceImage = imagecreatefromwebp($src);
//    $width = imagesx($sourceImage);
//    $height = imagesy($sourceImage);
//
//    /* find the "desired height" of this thumbnail, relative to the desired width  */
//    $desiredHeight = floor($height * ($desiredWidth / $width));
//
//    /* create a new, "virtual" image */
//    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
//
//    /* copy source image at a resized size */
//    imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
//
//    /* create the physical thumbnail image to its destination */
//    imagewebp($virtualImage, $dest);
}

function logging($data): void
{
    if (is_object($data)) {
        $data = (array)$data;
    }
    if (is_array($data)) {
        $r = file_put_contents(
            'log_' . date('j.n.Y') . '.log',
            date('H:i:s') . '#' . print_r($data, true) . "\n",
            FILE_APPEND
        );
        if ($r === false) {
            echo 'mist';
        }
    } else {
        $r = file_put_contents('log_' . date('j.n.Y') . '.log', date('H:i:s') . '#' . $data . "\n", FILE_APPEND);
        if ($r === false) {
            echo 'mist';
        }
    }
}
