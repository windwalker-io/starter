<!DOCTYPE html>
<html lang="<?php echo $app->get('language.locale') ?: $app->get('language.default', 'en-GB'); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php $this->block('page_title'); ?><?php $this->endblock(); ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $uri->path; ?>/asset/images/favicon.ico" />
    <meta name="generator" content="Windwalker Framework" />
    <?php $this->block('meta'); ?>
    <?php $this->endblock(); ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $uri->path; ?>/asset/css/main.css" />
    <?php $this->block('style'); ?><?php $this->endblock(); ?>
    <?php echo $asset->renderStyles(true); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
    <?php $this->block('script'); ?><?php $this->endblock(); ?>
    <?php echo $asset->renderScripts(true); ?>
</head>
<body>
<?php $this->block('navbar'); ?>
<div class="navbar navbar-default navbar-fixed-top fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $router->route('home'); ?>">
            <img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png" alt="Windwalker LOGO" />
        </a>
        <button type="button" class="navbar-toggle navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php $this->block('nav'); ?>
                <li class="nav-item active"><a class="nav-link" href="<?php echo $router->route('home'); ?>">Home</a></li>
                <?php $this->endblock(); ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
<?php $this->endblock(); ?>

<?php $this->block('message') ?>
<div id="messasge" class="container">
    <?php echo $widget->render('windwalker.message.default', ['messages' => $messages]); ?>
</div>
<?php $this->endblock(); ?>

<?php $this->block('content') ?>
Contnet
<?php $this->endblock(); ?>

<?php $this->block('copyright') ?>
<div id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <hr />

                <footer>
                    &copy; Windwalker <?php echo $datetime->format('Y'); ?>
                </footer>
            </div>
        </div>
    </div>
</div>
<?php $this->endblock(); ?>
<?php echo $asset->getTemplate()->renderTemplates(); ?>
</body>
</html>
