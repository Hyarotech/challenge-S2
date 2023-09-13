<?php

namespace App\Controllers;

use App\Configs\PageConfig;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use Carbon\Carbon;
use Core\ResourceView;
use Core\Session;
use Core\SqlOperator;
use DateTime;

class HomeController
{
    public function index(): ResourceView
    {
        $pseudo = "Prof";
        $view = new ResourceView("Main/index", "front");

        $view->assign("pseudo", $pseudo);
        return $view;
    }

    public function dashboard(): ResourceView
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalPages = Page::count();
        $view = new ResourceView("Main/dashboard", "back");
        $view->assign("totalUsers", $totalUsers);
        $view->assign("totalCategories", $totalCategories);
        $view->assign("totalPages", $totalPages);
        return $view;
    }
}
