<?php
namespace App\Helpers;

class Menu {
    public static function sidenav($menus, $parentId = null)
    {
        
        if ($parentId != null) { // if menu list is children
            echo '<ul class="list-unstyled ps-4 collapse" id="menu-parent' . '-' . $parentId.'">';
            foreach ($menus as $menu) {
                echo '<li class="text-white">';
    
                // div wrapper for head menu
                if(array_key_exists('children', $menu)) {
                    echo '<div>'. $menu['menu_name'] .'</div>';
                } else {
                    echo '<a href="' . $menu['menu_path'] .'">' . $menu['menu_name'] . '</a>';
                }
    
                // recursive condition
                if (array_key_exists('children', $menu)) {
                    self::sidenav($menu['children'], $menu['seq_id']);
                }
                echo '</li>';
            }
            echo '</ul>';
        } else { // if menu list is root
            echo '<ul class="list-unstyled ps-4">';
            foreach ($menus as $menu) {
                echo '<li class="text-white">';
    
                // div wrapper for head menu
                if(array_key_exists('children', $menu)) {
                    echo '<div data-bs-toggle="collapse" data-bs-target="#menu-parent-' . $menu['seq_id'] . '">'. $menu['menu_name'] .'</div>';
                } else {
                    echo '<a href="' . $menu['menu_path'] .'">' . $menu['menu_name'] . '</a>';
                }
    
                // recursive condition
                if (array_key_exists('children', $menu)) {
                    self::sidenav($menu['children'], $menu['seq_id']);
                }
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}