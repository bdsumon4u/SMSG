<?php

namespace App\View\Composers;

use App\Sidebar\MainSidebar;
use Hotash\Sidebar\Presentation\SidebarRenderer;

class SidebarCreator
{
    public function __construct(protected MainSidebar $sidebar, protected SidebarRenderer $renderer)
    {
    }

    public function create($view)
    {
        $view->sidebar = $this->renderer->render(
            $this->sidebar
        );
    }
}
