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
                'role' => '1'
            )
        )
    ),
    array(
        'name' => 'STAFF',
        'type'  => 'heading',
        'sidebarItem' => array(
            array(
                'name'  => 'Order Approval',
                'icon'  => 'fa-solid fa-sack-dollar',
                'url'   => 'approval',
                'role' => '2',
            ),
            array(
                'name'  => 'Vehicle Inspection',
                'icon'  => 'fa-solid fa-check-to-slot',
                'url'   => 'inspector',
                'role' => '3'
            ),
            
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
                'role' => '4',
                'subitem' => array(
                    array(
                        'name'  => 'All',
                        'icon'  => 'fa fa-list-alt',
                        'url'   => 'vehicles',
                        'role' => 'allvehiclecategory'
                    ),
                    array(
                        'name'  => 'Categories',
                        'icon'  => 'fa fa-list-alt',
                        'url'   => 'vehicles/vehiclecategory',
                        'role' => '5'
                    ),
                    array(
                        'name'  => 'Colors',
                        'icon'  => 'fa fa-list-alt',
                        'url'   => 'vehicles/colors',
                        'role' => '6'
                    ),
                    array(
                        'name'  => 'Makes',
                        'icon'  => 'fa fa-list-alt',
                        'url'   => 'vehicles/makes',
                        'role' => '7'
                    ),
                    array(
                        'name'  => 'Models',
                        'icon'  => 'fa fa-list-alt',
                        'url'   => 'vehicles/models',
                        'role' => '8'
                    ),
                ),
            ),
            array(
                'name'  => 'Rental Orders',
                'icon'  => 'fa fa-receipt',
                'url'   => 'rentalorders',
                'role' => '9',
            ),
            array(
                'name'  => 'Inspections',
                'icon'  => 'fa-solid fa-fire',
                'url'   => 'inspections',
                'role' => '10',
                'subitem' => array(
                    array(
                        'name'  => 'All',
                        'icon'  => 'fa fa-list-alt',
                        'url'   => 'inspections',
                        'role' => 'allinspections'
                    ),
                    array(
                        'name'  => 'Damage Types',
                        'icon'  => 'fa-solid fa-keyboard',
                        'url'   => 'inspections/damagetypes',
                        'role' => '11'
                    ),
                    array(
                        'name'  => 'Deposits',
                        'icon'  => 'fa-solid fa-keyboard',
                        'url'   => 'inspections/deposits',
                        'role' => '12'
                    ),
                ),
            ),
            array(
                'name'  => 'Reviews',
                'icon'  => 'fa-solid fa-star',
                'url'   => 'reviews',
                'role' => '13',                
            ),
            array(
                'name'  => 'Promotions',
                'icon'  => 'fa-solid fa-ticket',
                'url'   => 'promotions',
                'role' => '15',                
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
                'role' => '16',
            ),
            array(
                'name'  => 'Customers',
                'icon'  => 'fa-solid fa-circle-user',
                'url'   => 'customers',
                'role' => '17',
            ),
            array(
                'name'  => 'Permissions',
                'icon'  => 'fa-solid fa-users-gear',
                'url'   => 'permissions',
                'role' => '18'
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
function getActiveSub() {
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);
    return $components[3] ?? "";  
}
function build_Sidebar() {
    // Loại bỏ các sidebar item không có trong session nhóm quyền
    foreach($GLOBALS['sidebar'] as $key => &$sidebarGroup) {
        if (isset($sidebarGroup['sidebarItem'])) {
            foreach ($sidebarGroup['sidebarItem'] as $key1 => $item) {
                if (!isset($_SESSION['Roles'][$item['role']])) {
                    unset($sidebarGroup['sidebarItem'][$key1]);
                }
            }
            // Nếu nhóm không còn item nào thì xoá luôn
            if (empty($sidebarGroup['sidebarItem'])) {
                unset($GLOBALS['sidebar'][$key]);
            }
        }
    }
    
    
    // Sau khi xoá các sidebarbar item không có trong session nhóm quyền thì duyệt mảng tạo sidebarbar
    $html = '';
    $current_page = getActiveSidebar();
    $current_page_sub = getActiveSub();
    foreach($GLOBALS['sidebar'] as $sidebar) {
        if(isset($sidebar['sidebarItem']) && isset($sidebar['type']) && count($sidebar['sidebarItem']) > 0) {
            $html .= "<li class=\"nav-main-heading\">".$sidebar['name']."</li>";
            foreach ($sidebar['sidebarItem'] as $sidebarItem) {
                // Kiểm tra nếu subitem chỉ có một phần tử
                if (isset($sidebarItem['subitem']) && count($sidebarItem['subitem']) === 1) {
                    $singleSubItem = $sidebarItem['subitem'][0]; // Lấy phần tử duy nhất
                    if (isset($singleSubItem['role']) && $singleSubItem['role'] === 'all'.$sidebarItem['role']) {
                        unset($sidebarItem['subitem']); // Xóa subitem nếu thỏa điều kiện
                    }
                }

                $link_name = '<span class="nav-main-link-name">' . $sidebarItem['name'] . '</span>' . "\n";
                $link_icon = '<i class="nav-main-link-icon ' . $sidebarItem['icon'] . '"></i>' . "\n";
                
                $isActive = ($current_page === $sidebarItem['url']);
                // Kiểm tra submenu có active không
                if (isset($sidebarItem['subitem']) && count($sidebarItem['subitem']) > 0) {
                    foreach ($sidebarItem['subitem'] as $subitem) {
                        if ($current_page == $subitem['url']) {
                            $isActive = true; // Nếu có submenu active, cha cũng active luôn
                            break;
                        }
                    }
                }


                $html .= "<li class=\"nav-main-item\">"."\n";
                // $html .= "<a class=\"nav-main-link".($current_page == $sidebarItem['url'] ? " active" : "")."\" href=\"./".$sidebarItem['url']."\">";
                // Kiểm tra submenu đúng cách
                if (isset($sidebarItem['subitem']) && !empty($sidebarItem['subitem'])) {
                    $html .= "<a class=\"nav-main-link nav-main-link-submenu" . ($isActive ? " active" : "") . "\" 
                                data-toggle=\"submenu\" 
                                aria-haspopup=\"true\" 
                                aria-expanded=\"false\" 
                                href=\"#\">";
                } else {
                    $html .= "<a class=\"nav-main-link" . ($isActive ? " active" : "") . "\" 
                                href=\"" .BASE_URL ."/admin/" . $sidebarItem['url'] . "\">";
                }              
                $html .= $link_icon;
                $html .= $link_name;

                $html .= "</a>\n";
                // Render submenu nếu có
                if (isset($sidebarItem['subitem']) && count($sidebarItem['subitem']) > 0) {
                    $html .= "<ul class=\"nav-main-submenu\">";
                    foreach ($sidebarItem['subitem'] as $subitem) {
                        $link_name_sub = '<span class="nav-main-link-name">' . $subitem['name'] . '</span>' . "\n";
                        $html .= "<li class=\"nav-main-item\">" . "\n";
                        $html .= "<a class=\"nav-main-link" . ($current_page ."/".$current_page_sub === $subitem['url']  ? " active" : "") . "\" href=\"" .BASE_URL ."/admin/" . $subitem['url'] . "\">";
                        $html .= $link_name_sub;
                        $html .= "</a></li>\n";
                    }   
                    $html .= "</ul></li>\n";
                }

            }
        }
    }
    echo $html;
}
?>