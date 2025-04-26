(function () {
  function initValidation() {
    const form = document.querySelector("#profileForm");
    if (!form) return;

    const name = document.getElementById("dm-profile-edit-name");
    const email = document.getElementById("dm-profile-edit-email");
    const phoneNumb = document.getElementById("dm-profile-edit-phone-number");
    const birth = document.getElementById("dm-profile-edit-birth");
    const idCard = document.getElementById("dm-profile-edit-id-card");

    function isValidDate(date) {
      const birthPattern = /^\d{4}-\d{2}-\d{2}$/;
      return birthPattern.test(date);
    }

    function isValidEmail(email) {
      const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return emailPattern.test(email);
    }

    function isValidPhone(phone) {
      const phonePattern = /^[0-9]{10}$/;
      return phonePattern.test(phone);
    }

    function isValidIdCard(id) {
      const idPattern = /^[0-9]{9,12}$/;
      return idPattern.test(id);
    }

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

    // Thêm sự kiện kiểm tra real-time
    [name, email, phoneNumb, birth, idCard].forEach(field => {
      if (field) {
        field.addEventListener("input", function () {
          validateField(field);
        });
      }
    });

    function validateField(input) {
      if (input === name && !input.value.trim()) {
        showError(input, "Vui lòng nhập tên");
        return false;
      }
      if (input === email) {
        if (!input.value.trim()) {
          showError(input, "Vui lòng nhập email");
          return false;
        }
        if (!isValidEmail(input.value.trim())) {
          showError(input, "Email không hợp lệ");
          return false;
        }
      }
      if (input === phoneNumb) {
        if (!input.value.trim()) {
          showError(input, "Vui lòng nhập số điện thoại");
          return false;
        }
        if (!isValidPhone(input.value.trim())) {
          showError(input, "Số điện thoại không hợp lệ (10 số)");
          return false;
        }
      }
      if (input === birth) {
        if (!input.value.trim()) {
          showError(input, "Vui lòng nhập ngày sinh");
          return false;
        }
        if (!isValidDate(input.value.trim())) {
          showError(input, "Ngày sinh phải có định dạng yyyy-mm-dd");
          return false;
        }
      }
      if (input === idCard) {
        if (!input.value.trim()) {
          showError(input, "Vui lòng nhập số CMND");
          return false;
        }
        if (!isValidIdCard(input.value.trim())) {
          showError(input, "Số CMND phải từ 9-12 chữ số");
          return false;
        }
      }

      clearError(input);
      return true;
    }

    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      let isValid = true;
      let firstInvalidField = null;

      // Kiểm tra từng trường
      [name, email, phoneNumb, birth, idCard].forEach(field => {
        if (field && !validateField(field)) {
          isValid = false;
          if (!firstInvalidField) firstInvalidField = field;
        }
      });

      // Kiểm tra sex và thay đổi giá trị 0 cho Male, 1 cho Female
      const sexInput = document.querySelector('input[name="sex"]:checked');
      if (!sexInput) {
        isValid = false;
        showNotify("danger", "fa fa-times me-1", "Vui lòng chọn giới tính");
      }

      // Nếu sexInput được chọn, chuyển giá trị 'Male' -> 0, 'Female' -> 1
      const sexValue = sexInput ? (sexInput.value === "Male" ? 0 : 1) : null;

      if (!isValid) {
        if (firstInvalidField) firstInvalidField.focus();
        return;
      }

      // Nếu hợp lệ, tiến hành gửi
      const submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;

      try {
        const response = await fetch(BaseUrl + "profile/update", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            name: name.value.trim(),
            email: email.value.trim(),
            phone: phoneNumb.value.trim(),
            birth: birth.value.trim(),
            idCard: idCard.value.trim(),
            sex: sexValue, // Gửi 0 hoặc 1 cho sex
          }),
        });

        const result = await response.json();
        console.log(result);

        if (result.success) {
          showNotify("success", "fa fa-check me-1", "Cập nhật thành công");
        } else {
          showNotify("danger", "fa fa-times me-1", result.message || "Cập nhật thất bại");
        }
      } catch (error) {
        console.error("Error details: ", error);
        showNotify("danger", "fa fa-times me-1", "Đã xảy ra lỗi khi gửi dữ liệu.");
      } finally {
        if (submitBtn) submitBtn.disabled = false;
      }
    });
  }

  initValidation();
})();
