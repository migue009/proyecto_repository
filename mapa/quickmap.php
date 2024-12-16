<?php

/*
 Application:  QuickMap
 Purpose:      Use this file to test mapfiles
 Author:       Bill Bronsema (bbronsema@dmsolutions.ca)
 Copyright:    2005-2007, DM Solutions Group Inc.
 Instructions: - modify the MAPFILE path and the name of the phpmapscript
                 MODULE (lines 16 & 17)
               - in a web browser goto http://127.0.0.1/quickmap.php
               - an image of your data should be displayed in your browser, or
                 a MapServer error
 */

// define variables
define( "MAPFILE", "C:/ms4w/apps/gmap/htdocs/gmap75.map" );
define( "MODULE", "php_mapscript.dll" );

// load the mapscript module
if (!extension_loaded("MapScript")) dl(MODULE);

// open map
$oMap = ms_newMapObj( MAPFILE );

//force all errors to display
//  comment out the next 2 lines, useful on servers not displaying errors
//ini_set('display_errors','On');
//error_reporting(E_ALL);

// set projection if necessary
//$oMap->setProjection("init=epsg:42304");

// set image size
$oMap->setsize(400, 300);

// set image format
$oMap->selectoutputformat("png");

// draw map
$oImage = $oMap->draw();

// set header
header("Content-type: image/gif");

// output map
$url = $oImage->saveImage("");

?>