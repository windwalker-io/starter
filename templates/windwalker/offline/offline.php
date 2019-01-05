<?php
/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

?><!DOCTYPE html>
<html lang="<?php echo $app->get('language.locale', 'en-GB'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>Offline</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $asset->path; ?>/images/favicon.ico" />
    <meta name="generator" content="Windwalker Framework" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
</head>
<body>
<style>
    main {
        min-height: 100vh;
    }
</style>
<main class="main-wrapper d-flex flex-column">
    <div class="main-body container flex-grow-1 d-flex align-items-center">
        <div class="text-center mx-auto">
            <img src="https://i.imgur.com/Wn1FPH5.png" alt="logo" />
            <h2>Site Offline</h2>
            <p>Sorry, we are maintaining, please come back later.</p>
        </div>
    </div>

    <div id="copyright" class="">
        <div class="container">
            <footer class="py-4 border-top text-center">
                &copy; Windwalker <?php echo gmdate('Y'); ?>
            </footer>
        </div>
    </div>
</main>
</body>
</html>
