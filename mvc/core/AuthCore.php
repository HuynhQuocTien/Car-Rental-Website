<?php
require_once "./mvc/models/AccountModel.php";

class AuthCore {

    // Gọi khi truy cập trang login
    public static function onLogin() {
        $web = isset($_GET["url"]) ? explode("/", filter_var(trim($_GET["url"], "/"))) : null;

        if (isset($_COOKIE['token'])) {
            $accountModel = new AccountModel();
            $token = $_COOKIE['token'];
            if ($accountModel->validateToken($token)) {
                // Kiểm tra quyền để redirect đúng trang
                $role = $_SESSION['RoleID'];
                if ($role == 0) {
                    header("Location:" .BASE_URL.  "/user/home");
                    exit;
                } else {
                    header("Location:" .BASE_URL.  "/admin/welcome");
                    exit;
                }
            }
        }
    }

    // Gọi ở đầu mỗi trang cần bảo vệ
    public static function checkAuthentication() {
        $web = isset($_GET["url"]) ? explode("/", filter_var(trim($_GET["url"], "/"))) : null;
        $token = $_COOKIE['token'] ?? null;
        $accountModel = new AccountModel();

        if (!$token || !$accountModel->validateToken($token)) {
            // Token không hợp lệ hoặc hết hạn
            setcookie("token", "", time() - 3600, "/");
            if ($web[0] == "admin") {
                header("Location:" .BASE_URL.  "/admin/auth/signin");
                exit;
            } else {
                header("Location:" .BASE_URL.  "/user/home");
                exit;
            }
        } else {
            // Đã login nhưng kiểm tra phân quyền
            $role = $_SESSION['RoleID'];
            if ($web[0] == "admin" && $role == 0) {
                header("Location:" .BASE_URL.  "/user/home");
                
                exit;
            } else if ($web[0] == "user" && $role > 0) {
                header("Location:" .BASE_URL.  "/admin/auth/signin");
                exit;
            }
        }
    }
}
?>
