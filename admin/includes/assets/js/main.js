document.addEventListener("DOMContentLoaded", () => {
  const deleteButtons = document.querySelectorAll(".btn-delete");
  const confirmDelete = document.getElementById("confirm-delete");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const userid = button.getAttribute("data-id");

      confirmDelete.setAttribute("href", `?page=delete&userid=${userid}`);
    });
  });
});
