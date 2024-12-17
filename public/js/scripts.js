document.addEventListener("DOMContentLoaded", () => {
  const userModal = document.getElementById("userModal");
  const modalTitle = document.getElementById("modalTitle");
  const userForm = document.getElementById("userForm");
  const userIdInput = document.getElementById("userId");
  const userNameInput = document.getElementById("userName");
  const userEmailInput = document.getElementById("userEmail");
  const addUserBtn = document.getElementById("addUserBtn");
  const closeModal = document.querySelector(".close");

  // Show modal
  addUserBtn.addEventListener("click", () => {
    modalTitle.textContent = "Add User";
    userForm.reset();
    userIdInput.value = "";
    userModal.style.display = "flex";
  });

  document.querySelectorAll(".edit-btn").forEach((button) => {
    button.addEventListener("click", (e) => {
      modalTitle.textContent = "Edit User";
      userIdInput.value = e.target.dataset.id;
      userNameInput.value = e.target.dataset.name;
      userEmailInput.value = e.target.dataset.email;
      userModal.style.display = "flex";
    });
  });

  // Close modal
  closeModal.addEventListener("click", () => {
    userModal.style.display = "none";
  });

  // Form submission
  userForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(userForm);
    const response = await fetch("../controllers/UserController.php", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();
    if (result.success) {
      window.location.reload();
    } else {
      alert("An error occurred: " + result.message);
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const deleteButtons = document.querySelectorAll(".delete-btn");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", async (e) => {
      const id = e.target.dataset.id;

      if (confirm("Are you sure you want to delete this user?")) {
        const formData = new FormData();
        formData.append("id", id);
        formData.append("action", "delete");

        try {
          const response = await fetch("../controllers/UserController.php", {
            method: "POST",
            body: formData,
          });

          const result = await response.json();
          console.log(result); // Debugging response

          if (result.success) {
            window.location.reload();
          } else {
            alert("An error occurred: " + result.message);
          }
        } catch (error) {
          console.error("Fetch error:", error); // Debugging fetch error
          alert("An error occurred while processing the request.");
        }
      }
    });
  });
});
