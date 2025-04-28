(function () {
  const scriptMap = {
    dropDownBtn: "../public/js/pages/admin/dashboardRange.js",
  };

  function removeOldScript(){
    const oldScripts = document.querySelectorAll('script[src*="admin/"]');
    oldScripts.forEach((script) => script.remove());
  }
  
  function loadScript(type) {
    //xoa script cũ
    removeOldScript();
    // load script hiện
    const scriptSrc = scriptMap[type];
    if (scriptSrc) {
      const script = document.createElement("script");
      script.type = "text/javascript";
      script.src = scriptSrc;

      // Thêm vào thẻ <head>
      document.head.appendChild(script);
    }
  }

  function bindEvents() {
    loadScript("dropDownBtn");
    // document
    //   .getElementById("dropdown-analytics-overview")
    //   .addEventListener("click", function () {
    //     loadScript("dropDownBtn");
    //   });
  }
  bindEvents();
})();
