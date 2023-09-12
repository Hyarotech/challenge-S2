<?php


function renderMenu(string $menuItems,bool $isRelative = false) {
    $menuItems = json_decode($menuItems, true);
   
    $classSubMenu = $isRelative ? 'relative' : 'absolute translate-y-full';
    foreach ($menuItems as $item) {
        if($item['type'] == 'page'){
            $page = App\Models\Page::findBy('id',(int)$item['link']);
            if($page instanceof App\Models\Page){
                $item['link'] = \Core\Router::generateDynamicRoute('page',[
                    'slug' => $page->getSlug()
                ]);
            }
            else
                $item['link'] = '#URL_INVALIDE';
        }
               
            
        
        $children = json_encode($item['children'],true);
        echo '<li class="z-[1]" tabindex="0">';
        if (empty($item['children'])) 
            echo '<a class="whitespace-nowrap" href="' . $item['link'] . '">' . $item['title'] . '</a>';
        else {
            echo '<details class="relative">';
            echo '<summary class="whitespace-nowrap">' . $item['title'] . '</summary>';
            echo '<ul class="bg-base-200 p-2 card w-auto '.$classSubMenu.' bottom-0  left-0">';
            renderMenu($children,true);  // appel récursif pour les enfants
            echo '</ul>';
            echo '</details>';
        }
        echo '</li>';
    }
}
function renderMenuMobile(string $menuItems) {
    $menuItems = json_decode($menuItems, true);
    foreach ($menuItems as $item) {
        if($item['type'] == 'page'){
            $page = App\Models\Page::findBy('id',(int)$item['link']);
            if($page instanceof App\Models\Page){
                $item['link'] = \Core\Router::generateDynamicRoute('page',[
                    'slug' => $page->getSlug()
                ]);
            }
            else
                $item['link'] = '#URL_INVALIDE';
        }

        $children = json_encode($item['children'],true);
        echo '<li class="relative">';
        echo '<a class="whitespace-nowrap" href="' . $item['link'] . '">' . $item['title'] . '</a>';
        if(!empty($item['children'])){
            echo '<ul class="p-2 bg-base-300 dropdown-content menu menu-sm">';
            renderMenuMobile($children);
            echo '</ul>';
        }
        
        echo '</li>';
    }
}

?>


<div class="navbar w-full bg-base-100">
<div class="navbar-start">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
      </label>
      
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <?php
            renderMenuMobile(
                \App\Models\Setting::findBy('key','menu_json')->getValue()
            );
        ?>
            </ul>
    </div>

  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <?php
            renderMenu(
                \App\Models\Setting::findBy('key','menu_json')->getValue()
            ); 
      ?>
    </ul>
  </div>
  <div class="navbar-end">
  <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    </label>
                   
                    <ul tabindex="0"
                        class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <a class="justify-between">
                                Profile
                                <span class="badge">New</span>
                            </a>
                        </li>
                        <li><a>Settings</a></li>
                        <li><a href="<?= \Core\Router::generateRoute('security.logout'); ?>">Logout</a></li>
                    </ul>
                </div>

  </div>
            
</div>