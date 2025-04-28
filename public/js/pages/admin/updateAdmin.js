(function(){
  // const forms = [
  //   document.getElementById("profileForm"),
  //   document.getElementById("passwordForm"),
  // ];
  const scriptMap = {
    profile: "../public/js/pages/admin/updateAdminProfile.js",
    password: "../public/js/pages/admin/updateAdminPassword.js",
  };

  function loadScript(formType) {
    // Xóa tất cả các thẻ <script> có src chứa "user/"
    const oldScripts = document.querySelectorAll('script[src*="admin/"]');
    oldScripts.forEach((script) => script.remove());

    // Lấy đường dẫn script tương ứng từ map
    const scriptSrc = scriptMap[formType];
    if (scriptSrc) {
      const script = document.createElement("script");
      script.type = "text/javascript";
      script.src = scriptSrc;

      // Thêm vào thẻ <head>
      document.head.appendChild(script);
    }
  }

  function bindEvents() {
    loadScript("profile");
    document
      .getElementById("account-profile-tab")
      .addEventListener("click", function () {
        loadScript("profile");
      });

    document
      .getElementById("account-password-tab")
      .addEventListener("click", function () {
        loadScript("password");
      });
  }
  bindEvents();
})();