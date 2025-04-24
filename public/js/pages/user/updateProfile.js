(function () {
  function initValidation() {
    const form = document.querySelector("#profileForm");
    if (!form) return;

    const name = document.getElementById("dm-profile-edit-name");
    const email = document.getElementById("dm-profile-edit-email");
    const phoneNumb = document.getElementById("dm-profile-edit-phone-number");
    const birth = document.getElementById("dm-profile-edit-birth");
    const idCard = document.getElementById("dm-profile-edit-id-card");

    if (name) {
      name.addEventListener("input", function () {
        if (!name.value.trim()) {
          showError(name, "Vui lòng nhập tên");
        } else {
          clearError(name);
        }
      });
    }

    if (email) {
      email.addEventListener("input", function () {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!email.value.trim()) {
          showError(email, "Vui lòng nhập email");
        } else if (!emailPattern.test(email.value.trim())) {
          showError(email, "Email không hợp lệ");
        } else {
          clearError(email);
        }
      });
    }

    if (phoneNumb) {
      phoneNumb.addEventListener("input", function () {
        const phonePattern = /^[0-9]{10}$/;
        if (!phoneNumb.value.trim()) {
          showError(phoneNumb, "Vui lòng nhập số điện thoại");
        } else if (!phonePattern.test(phoneNumb.value.trim())) {
          showError(phoneNumb, "Số điện thoại không hợp lệ");
        } else {
          clearError(phoneNumb);
        }
      });
    }

    if (birth) {
      birth.addEventListener("input", function () {
        const birthPattern = /^\d{4}-\d{2}-\d{2}$/;
        if (!birth.value.trim()) {
          showError(birth, "Vui lòng nhập ngày sinh");
        } else if (!birthPattern.test(birth.value.trim())) {
          showError(birth, "Ngày sinh phải có định dạng yyyy-mm-dd");
        } else {
          clearError(birth);
        }
      });
    }

    if (idCard) {
      idCard.addEventListener("input", function () {
        const idCardPattern = /^[0-9]{9,12}$/;
        if (!idCard.value.trim()) {
          showError(idCard, "Vui lòng nhập số CMND");
        } else if (!idCardPattern.test(idCard.value.trim())) {
          showError(idCard, "Số CMND không hợp lệ (9-12 chữ số)");
        } else {
          clearError(idCard);
        }
      });
    }

    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      let isValid = true;

      if (!name.value.trim()) {
        showError(name, "Vui lòng nhập tên");
        isValid = false;
      } else {
        clearError(name);
      }

      if (!email.value.trim()) {
        showError(email, "Vui lòng nhập email");
        isValid = false;
      } else {
        clearError(email);
      }

      if (!phoneNumb.value.trim()) {
        showError(phoneNumb, "Vui lòng nhập số điện thoại");
        isValid = false;
      } else {
        clearError(phoneNumb);
      }

      if (!birth.value.trim()) {
        showError(birth, "Vui lòng nhập ngày sinh");
        isValid = false;
      } else {
        clearError(birth);
      }

      if (!idCard.value.trim()) {
        showError(idCard, "Vui lòng nhập số CMND");
        isValid = false;
      } else {
        clearError(idCard);
      }

      if (isValid) {
        console.log("Form hợp lệ, gửi yêu cầu");

        try {
          console.log(BaseUrl + "profile/update");
         
          const response = await fetch(BaseUrl + "profile/update", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              name: name.value.trim(),
              email: email.value.trim(),
              phone: phoneNumb.value.trim(),
              birth: birth.value.trim(),
              idCard: idCard.value.trim(),
            }),
          });
          const textResponse = await response.text(); // Nhận dữ liệu dưới dạng text
          console.log(textResponse);
          const result = await response.json();

          if (result.success) {
            showNotify("success", "fa fa-check me-1", "Cập nhật thành công");
          } else {
            showNotify(
              "danger",
              "fa fa-times me-1",
              result.message || "Cập nhật thất bại"
            );
          }
        } catch (error) {
          console.error("Error details: ", error);
          showNotify(
            "danger",
            "fa fa-times me-1",
            "Đã xảy ra lỗi khi gửi dữ liệu."
          );
        }
      }
    });
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

  initValidation();
})();
