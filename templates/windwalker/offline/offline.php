<?php
/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

?><!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Offline</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $asset->path; ?>/images/favicon.ico" />
    <meta name="generator" content="Windwalker Framework" />

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $asset->path; ?>/css/main.css" />

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $uri->full; ?>">
                <img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png" alt="Windwalker LOGO" />
            </a>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center" style="margin-top: 50px; margin-bottom: 70px">
            <img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png" alt="img" />
            <h2>Site Offline</h2>
            <p>Sorry, we are maintaining, please come back later.</p>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <hr />

                <footer>
                    &copy; Windwalker <?php echo gmdate('Y'); ?>
                </footer>
            </div>
        </div>
    </div>
</div>
</body>
</html>
