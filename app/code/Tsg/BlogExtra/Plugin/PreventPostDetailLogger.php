<?php declare(strict_types=1);

namespace Tsg\BlogExtra\Plugin;

use Tsg\Blog\Observer\LogPostDetailView;

class PreventPostDetailLogger
{
    public function aroundExecute(
        LogPostDetailView $subject,
        callable $proceed,
    ){
        // Don't do anything to prevent logger from executing
    }
}
