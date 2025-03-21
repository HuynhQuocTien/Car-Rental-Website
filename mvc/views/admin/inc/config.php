<?php
$GLOBALS['sidebar'] = array(
    array(
        'name'  => 'Dashboard',
        'type'  => 'heading',
        'sidebarItem' => array(
            array(
                'name'  => 'Dashboard',
                'icon'  => 'fa fa-tachometer',
                'url'   => 'dashboard',
                'role' => 'dashboard'
            )
        )
    ),
    array(
        'name' => 'Management',
        'type'  => 'heading',
        'sidebarItem' => array(
            array(
                'name'  => 'Vehicles',
                'icon'  => 'fa fa-car',
                'url'   => 'vehicles',
                'role' => 'vehicles'
            ),
            array(
                'name'  => 'Vehicle catalog',
                'icon'  => 'fa fa-list-alt',
                'url'   => 'vehiclecatalog',
                'role' => 'vehiclecatalog'
            ),
            array(
                'name'  => 'Rental Orders',
                'icon'  => 'fa fa-receipt',
                'url'   => 'rentalorders',
                'role' => 'rentalorders',
            ),
            array(
                'name'  => 'Customers',
                'icon'  => 'fa-solid fa-circle-user',
                'url'   => 'customers',
                'role' => 'customers'
            ),
            array(
                'name'  => 'Inspections',
                'icon'  => 'fa-solid fa-fire',
                'url'   => 'inspections',
                'role' => 'inspections'
            ),
            array(
                'name'  => 'Reviews',
                'icon'  => 'fa-solid fa-star',
                'url'   => 'reviews',
                'role' => 'reviews'
            ),
            array(
                'name'  => 'Damage Types',
                'icon'  => 'fa-solid fa-keyboard',
                'url'   => 'damagetypes',
                'role' => 'damagetypes'
            ),
        )
    ),
    array(
        'name' => 'Administrator',
        'type'  => 'heading',
        'sidebarItem' => array(
            
            array(
                'name'  => 'Users',
                'icon'  => 'fa-solid fa-users',
                'url'   => 'users',
                'role' => 'users'
            ),
            array(
                'name'  => 'Payments',
                'icon'  => 'fa-brands fa-paypal',
                'url'   => 'payments',
                'role' => 'payments'
            ),
            array(
                'name'  => 'Permissions',
                'icon'  => 'fa-solid fa-users-gear',
                'url'   => 'permissions',
                'role' => 'permissions'
            ),
        )
    )
);
// Xử lý url để active navbar
function getActiveSidebar() {
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);
    return $components[2];  
}

function build_Sidebar() {
    // Loại bỏ các sidebar item không có trong session nhóm quyền
    // foreach($GLOBALS['sidebar'] as $key => $sidebarItem) {
    //     if(isset($sidebar['sidebarItem'])) {
    //         foreach ($sidebar['sidebarItem'] as $key1 => $sidebarItem) {
    //             if(!array_key_exists($sidebarItem['role'],$_SESSION['user_role'])) {
    //                 unset($GLOBALS['sidebarbar'][$key]['sidebarItem'][$key1]);
    //             }
    //         }
    //     }
    // }
    
    // Sau khi xoá các sidebarbar item không có trong session nhóm quyền thì duyệt mảng tạo sidebarbar
    $html = '';
    $current_page = getActiveSidebar();
    foreach($GLOBALS['sidebar'] as $sidebar) {
        if(isset($sidebar['sidebarItem']) && isset($sidebar['type']) && count($sidebar['sidebarItem']) > 0) {
            $html .= "<li class=\"nav-main-heading\">".$sidebar['name']."</li>";
            foreach ($sidebar['sidebarItem'] as $sidebarItem) {
                $link_name = '<span class="nav-main-link-name">' . $sidebarItem['name'] . '</span>' . "\n";
                $link_icon = '<i class="nav-main-link-icon ' . $sidebarItem['icon'] . '"></i>' . "\n";
                $html .= "<li class=\"nav-main-item\">"."\n";
                $html .= "<a class=\"nav-main-link".($current_page == $sidebarItem['url'] ? " active" : "")."\" href=\"./".$sidebarItem['url']."\">";
                $html .= $link_icon;
                $html .= $link_name;
                $html .= "</a></li>\n";
            }
        }
    }
    echo $html;
}
?>