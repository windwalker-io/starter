<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app           \Windwalker\Web\Application                 Global Application
 * @var $package       \Windwalker\Core\Package\AbstractPackage    Package object.
 * @var $view          \Windwalker\Data\Data                       Some information of this view.
 * @var $uri           \Windwalker\Uri\UriData                     Uri information, example: $uri->path
 * @var $datetime      \DateTime                                   PHP DateTime object of current time.
 * @var $helper        \Windwalker\Core\View\Helper\Set\HelperSet  The Windwalker HelperSet object.
 * @var $router        \Windwalker\Core\Router\PackageRouter       Router object.
 * @var $asset         \Windwalker\Core\Asset\AssetManager         The Asset manager.
 */

?>

<div>
    <h1>Hello</h1>

    <form action="{{ $app->to('sakura_edit')->id(123) }}" method="post" enctype="multipart/form-data">
        <input type="text" name="hello" value="{{ $item['title'] ?? '' }}" />
        <input type="file" name="item[file]" id="input-file" />

        <button>Submit</button>
    </form>

    <a href="{{ $app->to('sakura') }}">
        Back
    </a>
</div>