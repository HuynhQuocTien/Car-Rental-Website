(function () {
  function initPasswordValidation() {
    const form = document.querySelector("#passwordForm");
    if (!form) return;

    const currentPassword = document.getElementById("dm-profile-edit-password");
    const newPassword = document.getElementById("dm-profile-edit-password-new");
    const confirmNewPassword = document.getElementById(
      "dm-profile-edit-password-new-confirm"
    );

    function showError(input, message) {
      let error = input.parentElement.querySelector(".error-message");
      if (!error) {
        error = document.createElement("span");
        error.className = "error-message";
        error.style.color = "red";
        error.style.fontSize = "0.9em";
        input.parentElement.appendChild(error);
      }
      error.textContent = message;
      input.classList.add("is-invalid");
    }

    function clearError(input) {
      const error = input.parentElement.querySelector(".error-message");
      if (error) error.remove();
      input.classList.remove("is-invalid");
    }

    function showNotify(type, icon, message) {
      if (typeof Dashmix !== "undefined" && Dashmix.helpers) {
        Dashmix.helpers("jq-notify", {
          type,
          icon,
          message,
          z_index: 9999,
        });
      } else {
        alert(message); // fallback
      }
    }
    // Kiểm tra trường hợp mật khẩu
    function validateField(input) {
      if (input === currentPassword && !input.value.trim()) {
        showError(input, "Vui lòng nhập mật khẩu hiện tại");
        return false;
      }
      if (input === newPassword) {
        if (!input.value.trim()) {
          showError(input, "Vui lòng nhập mật khẩu mới");
          return false;
        }
        if (input.value.trim().length < 6) {
          showError(input, "Mật khẩu mới phải có ít nhất 6 ký tự");
          return false;
        }
      }
      if (input === confirmNewPassword) {
        if (!input.value.trim()) {
          showError(input, "Vui lòng xác nhận mật khẩu mới");
          return false;
        }
        if (input.value.trim() !== newPassword.value.trim()) {
          showError(input, "Mật khẩu xác nhận không khớp");
          return false;
        }
      }

      clearError(input);
      return true;
    }

    // Thêm sự kiện kiểm tra real-time
    [currentPassword, newPassword, confirmNewPassword].forEach((field) => {
      if (field) {
        field.addEventListener("input", function () {
          validateField(field);
        });
      }
    });

    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      let isValid = true;
      let firstInvalidField = null;

      // Kiểm tra từng trường
      [currentPassword, newPassword, confirmNewPassword].forEach((field) => {
        if (field && !validateField(field)) {
          isValid = false;
          if (!firstInvalidField) firstInvalidField = field;
        }
      });

      if (!isValid) {
        if (firstInvalidField) firstInvalidField.focus();
        return;
      }

      // Nếu hợp lệ, tiến hành gửi
      const submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;

      try {
        const response = await fetch(BaseUrl + "profile/updatePassword", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            currentPassword: currentPassword.value.trim(),
            newPassword: newPassword.value.trim(),
            confirmNewPassword: confirmNewPassword.value.trim(),
          }),
        });

        const result = await response.json();
        console.log(result);

        if (result.success) {
          showNotify(
            "success",
            "fa fa-check me-1",
            "Cập nhật mật khẩu thành công"
          );
          currentPassword.value = "";
          newPassword.value = "";
          confirmNewPassword.value = "";
        } else {
          showNotify(
            "danger",
            "fa fa-times me-1",
            result.message || "Cập nhật mật khẩu thất bại"
          );
        }
      } catch (error) {
        console.error("Error details: ", error);
        showNotify(
          "danger",
          "fa fa-times me-1",
          "Đã xảy ra lỗi khi gửi dữ liệu."
        );
      } finally {
        if (submitBtn) submitBtn.disabled = false;
      }
    });
  }

  initPasswordValidation();
})();
