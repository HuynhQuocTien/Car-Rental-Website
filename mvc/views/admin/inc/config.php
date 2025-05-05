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
                        'name'  => 'Vehicles',
                        'icon'  => 'fa fa-car',
                        'url'   => 'vehicles',
                        'role' => '4',
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
                        'name'  => 'Inspections',
                        'icon'  => 'fa-solid fa-fire',
                        'url'   => 'inspections',
                        'role' => '10',
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
            // array(
            //     'name'  => 'Reviews',
            //     'icon'  => 'fa-solid fa-star',
            //     'url'   => 'reviews',
            //     'role' => '13',                
            // ),
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
// function build_Sidebar() {
//     // Lọc sidebar, chỉ giữ lại các item có role hợp lệ
//     foreach ($GLOBALS['sidebar'] as $key => $sidebarGroup) {
//         if (isset($sidebarGroup['sidebarItem'])) {
//             foreach ($sidebarGroup['sidebarItem'] as $key1 => &$item) {
//                 // Lọc subitem
//                 if (isset($item['subitem'])) {
//                     $originalCount = count($item['subitem']);
//                     $filteredCount = 0;
//                     $hasAll = false;
                    
//                     foreach ($item['subitem'] as $key2 => $subitem) {
//                         if (!isset($_SESSION['Roles'][$subitem['role']])) {
//                             unset($item['subitem'][$key2]);
//                         } else {
//                             $filteredCount++;
//                             if ($subitem['name'] === 'All') {
//                                 $hasAll = true;
//                             }
//                         }
//                     }
                    
//                     // Nếu tất cả subitem đều có trong session và chưa có mục "All"
//                     if ($originalCount === $filteredCount && !$hasAll) {
//                         // Thêm mục "All" vào đầu subitem
//                         array_unshift($item['subitem'], array(
//                             'name' => 'All',
//                             'icon' => 'fa fa-list-alt',
//                             'url' => $item['url'],
//                             'role' => 'all' . strtolower(str_replace(' ', '', $item['name']))
//                         ));
//                     }
                    
//                     // Nếu không còn subitem hợp lệ, xóa luôn subitem
//                     if (empty($item['subitem'])) {
//                         unset($item['subitem']);
//                     }
//                 }

//                 // Kiểm tra role của item chính
//                 if (!isset($_SESSION['Roles'][$item['role']])) {
//                     unset($sidebarGroup['sidebarItem'][$key1]);
//                 }
//             }

//             // Nếu không còn item nào trong nhóm, xóa nhóm sidebar
//             if (empty($sidebarGroup['sidebarItem'])) {
//                 unset($GLOBALS['sidebar'][$key]);
//             }
//         }
//     }

//     // Tạo HTML cho sidebar
//     $html = '';
//     $current_page = getActiveSidebar(); // Lấy trang hiện tại
//     $current_page_sub = getActiveSub(); // Lấy submenu hiện tại

//     foreach ($GLOBALS['sidebar'] as $sidebar) {
//         if (isset($sidebar['sidebarItem']) && isset($sidebar['type']) && count($sidebar['sidebarItem']) > 0) {
//             // Render heading của nhóm
//             $html .= "<li class=\"nav-main-heading\">{$sidebar['name']}</li>";

//             foreach ($sidebar['sidebarItem'] as $sidebarItem) {
//                 $functionId = $sidebarItem['role']; // Lấy chức năng của item
//                 $requiredPermissions = [4]; // Mặc định cần quyền "Xem"
//                 // if (!hasPermission($functionId, $requiredPermissions)) {
//                 //     continue; // Bỏ qua nếu không có quyền
//                 // }
//                 $link_name = '<span class="nav-main-link-name">' . $sidebarItem['name'] . '</span>' . "\n";
//                 $link_icon = '<i class="nav-main-link-icon ' . $sidebarItem['icon'] . '"></i>' . "\n";

//                 // Kiểm tra nếu item hoặc subitem đang active
//                 $isActive = ($current_page === $sidebarItem['url']);
//                 if (isset($sidebarItem['subitem'])) {
//                     foreach ($sidebarItem['subitem'] as $subitem) {
//                         if ($current_page === $subitem['url']) {
//                             $isActive = true;
//                             break;
//                         }
//                     }
//                 }

//                 // Bắt đầu render item
//                 $html .= "<li class=\"nav-main-item\">" . "\n";

//                 if (isset($sidebarItem['subitem']) && !empty($sidebarItem['subitem'])) {
//                     // Nếu có submenu
//                     $html .= "<a class=\"nav-main-link nav-main-link-submenu" . ($isActive ? " active" : "") . "\" 
//                                 data-toggle=\"submenu\" 
//                                 aria-haspopup=\"true\" 
//                                 aria-expanded=\"false\" 
//                                 href=\"#\">";
//                 } else {
//                     // Nếu không có submenu
//                     $html .= "<a class=\"nav-main-link" . ($isActive ? " active" : "") . "\" 
//                                 href=\"" . BASE_URL . "/admin/" . $sidebarItem['url'] . "\">";
//                 }

//                 $html .= $link_icon . $link_name . "</a>\n";

//                 // Render submenu nếu có
//                 if (isset($sidebarItem['subitem']) && count($sidebarItem['subitem']) > 0) {
//                     $html .= "<ul class=\"nav-main-submenu\">";
//                     foreach ($sidebarItem['subitem'] as $subitem) {
//                         $link_name_sub = '<span class="nav-main-link-name">' . $subitem['name'] . '</span>' . "\n";
//                         $isActiveSub = ($current_page_sub === $subitem['url']);
//                         $html .= "<li class=\"nav-main-item\">" . "\n";
//                         $html .= "<a class=\"nav-main-link" . ($isActiveSub ? " active" : "") . "\" 
//                                     href=\"" . BASE_URL . "/admin/" . $subitem['url'] . "\">";
//                         $html .= $link_name_sub . "</a></li>\n";
//                     }
//                     $html .= "</ul>";
//                 }

//                 $html .= "</li>\n"; // Kết thúc item
//             }
//         }
//     }

//     echo $html;
// }



function build_Sidebar() {
    $html = '';
    $current_page = getActiveSidebar();
    $current_page_sub = getActiveSub();

    foreach ($GLOBALS['sidebar'] as $sidebarGroup) {
        $validItems = [];
        
        if (isset($sidebarGroup['sidebarItem'])) {
            foreach ($sidebarGroup['sidebarItem'] as $item) {
                // Kiểm tra quyền item chính
                $hasAccess = isset($_SESSION['Roles'][$item['role']]);
                
                if (isset($item['subitem'])) {
                    $originalSubitems = $item['subitem'];
                    $filteredSubitems = [];
                    $hasAllItem = false;
                    
                    foreach ($originalSubitems as $subitem) {
                        if (isset($_SESSION['Roles'][$subitem['role']])) {
                            $filteredSubitems[] = $subitem;
                            if ($subitem['name'] === 'All') {
                                $hasAllItem = true;
                            }
                        }
                    }
                    
                    // Chỉ thêm "All" nếu có đủ subitems và chưa có
                    if (count($originalSubitems) === count($filteredSubitems) && !$hasAllItem) {
                        array_unshift($filteredSubitems, [
                            'name' => 'All',
                            'icon' => 'fa fa-list-alt',
                            'url' => $item['url'],
                            'role' => 'all_' . strtolower(str_replace(' ', '_', $item['name']))
                        ]);
                    }
                    
                    // Cập nhật lại subitems
                    $item['subitem'] = $filteredSubitems;
                    
                    // Chỉ thêm item nếu có subitems hoặc có quyền item chính
                    if (!empty($filteredSubitems) || $hasAccess) {
                        $validItems[] = $item;
                    }
                } 
                elseif ($hasAccess) {
                    $validItems[] = $item;
                }
            }
        }
        
        // Render HTML nếu có item hợp lệ
        if (!empty($validItems)) {
            $html .= "<li class=\"nav-main-heading\">{$sidebarGroup['name']}</li>";
            
            foreach ($validItems as $item) {
                $isActive = ($current_page == $item['url']);
                $hasSubmenu = isset($item['subitem']) && !empty($item['subitem']);
                
                $html .= "<li class=\"nav-main-item\">";
                
                if ($hasSubmenu) {
                    // Kiểm tra active subitem
                    foreach ($item['subitem'] as $subitem) {
                        if ($current_page == $subitem['url']) {
                            $isActive = true;
                            break;
                        }
                    }
                    
                    $html .= "<a class=\"nav-main-link nav-main-link-submenu" . ($isActive ? " active" : "") . "\" 
                              data-toggle=\"submenu\" aria-haspopup=\"true\" aria-expanded=\"false\" href=\"#\">";
                } else {
                    $html .= "<a class=\"nav-main-link" . ($isActive ? " active" : "") . "\" 
                              href=\"" . BASE_URL . "/admin/" . $item['url'] . "\">";
                }
                
                $html .= '<i class="nav-main-link-icon ' . $item['icon'] . '"></i>';
                $html .= '<span class="nav-main-link-name">' . $item['name'] . '</span>';
                $html .= "</a>";
                
                if ($hasSubmenu) {
                    $html .= "<ul class=\"nav-main-submenu\">";
                    foreach ($item['subitem'] as $subitem) {
                        $isActiveSub = ($current_page == $subitem['url']);
                        $html .= "<li class=\"nav-main-item\">";
                        $html .= "<a class=\"nav-main-link" . ($isActiveSub ? " active" : "") . "\" 
                                  href=\"" . BASE_URL . "/admin/" . $subitem['url'] . "\">";
                        $html .= '<span class="nav-main-link-name">' . $subitem['name'] . '</span>';
                        $html .= "</a></li>";
                    }
                    $html .= "</ul>";
                }
                
                $html .= "</li>";
            }
        }
    }
    
    echo $html;
}
// Hàm kiểm tra xem đã có mục "All" trong subitems chưa
function hasAllItem($subitems) {
    foreach ($subitems as $subitem) {
        if ($subitem['name'] === 'All') {
            return true;
        }
    }
    return false;
}
function hasPermission($functionId, $requiredPermissions) {
    if (!isset($_SESSION['Roles'][$functionId])) {
        return false; // Không có quyền cho chức năng này
    }
    foreach ($requiredPermissions as $permission) {
        if (in_array($permission, $_SESSION['Roles'][$functionId])) {
            return true; // Có ít nhất một quyền phù hợp
        }
    }
    return false;
}
?>