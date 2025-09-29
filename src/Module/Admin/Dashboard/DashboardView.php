<?php

declare(strict_types=1);

namespace App\Module\Admin\Dashboard;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Language\TranslatorTrait;
use Windwalker\Core\View\View;
use Windwalker\ORM\ORM;

/**
 * The DashboardView class.
 */
#[ViewModel(
    layout: 'dashboard',
    js: 'dashboard.ts'
)]
class DashboardView
{
    use TranslatorTrait;

    /**
     * DashboardView constructor.
     */
    public function __construct(protected ORM $orm)
    {
        //
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): array
    {
        return [];
    }

    #[ViewMetadata]
    public function prepareMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle($this->trans('unicorn.title.dashboard'));
    }
}
