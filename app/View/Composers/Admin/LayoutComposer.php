<?php


namespace App\View\Composers\Admin;

use Illuminate\View\View;

class LayoutComposer
{
    public const MAKEUP_VERSION = 16;
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('makeupVer', '?v=' . self::MAKEUP_VERSION);
    }
}
