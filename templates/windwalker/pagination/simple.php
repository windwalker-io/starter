<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2016 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Core\Pagination\PaginationResult;
use Windwalker\Data\Data;

/**
 * @var PaginationResult $pagination
 * @var callable         $route
 */
?>
<div class="windwalker-pagination">
    <div class="btn-group pull-left">
        <?php if ($pagination->getFirst()): ?>
            <a href="<?php echo $route(['page' => $pagination->getFirst()]); ?>"
                class="hasTooltip btn btn-default" title="First Page">
                <span class="glyphicon glyphicon-fast-backward"></span>
                <span class="sr-only">
                    First Page
                </span>
            </a>
        <?php endif; ?>

        <?php if ($pagination->getPrevious()): ?>
            <a href="<?php echo $route(['page' => $pagination->getPrevious()]); ?>"
                class="hasTooltip btn btn-default" title="Previous Page">
                <span class="glyphicon glyphicon-backward"></span>
                <span class="sr-only">
                    Previous Page
                </span>
            </a>
        <?php endif; ?>
    </div>

    <div class="pull-right">
	    <?php if ($pagination->getNext()): ?>
			<a href="<?php echo $route(['page' => $pagination->getNext()]); ?>"
				class="hasTooltip btn btn-default" title="Next Page">
				<span class="glyphicon glyphicon-forward"></span>
				<span class="sr-only">
					Next Page
				</span>
			</a>
	    <?php endif; ?>
    </div>
</div>
