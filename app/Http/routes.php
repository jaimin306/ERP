<?php

//Route::group(['middleware' => 'web'], function() {
    /**
     * Switch between the included languages
     */
    /*Route::group(['namespace' => 'Language'], function () {
        require (__DIR__ . '/Routes/Language/Language.php');
    });*/

    /**
     * Frontend Routes
     * Namespaces indicate folder structure
     */
    /*Route::group(['namespace' => 'Frontend'], function () {
        require (__DIR__ . '/Routes/Frontend/Frontend.php');
        require (__DIR__ . '/Routes/Frontend/Access.php');
    });*/
//});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
//Route::group(['namespace' => 'Frontend'], function () {
//Route::group(['namespace' => 'Admin', 'prefix' => 'Admin', 'middleware' => 'Admin'], function () {
Route::group(['namespace' => 'Admin'], function () {
    /**
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */

    //print_r($_REQUEST);
    require (__DIR__ . '/Routes/Admin/Dashboard.php');
    require (__DIR__ . '/Routes/Admin/Country.php');
    /*require (__DIR__ . '/Routes/Backend/Course.php');
    require (__DIR__ . '/Routes/Backend/Slider.php');
    require (__DIR__ . '/Routes/Backend/Module.php');
    require (__DIR__ . '/Routes/Backend/Access.php');
    require (__DIR__ . '/Routes/Backend/LogViewer.php');*/
});
