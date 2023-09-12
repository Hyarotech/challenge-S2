<?php
namespace App\Models;

use App\Configs\PageConfig;
use Core\Model;

use Core\Verificator;
class Article extends Page
{
    public function __construct()
    {
        parent::__construct();
        $this->setPageType(PageConfig::TYPE['article']);
    }

    
}


