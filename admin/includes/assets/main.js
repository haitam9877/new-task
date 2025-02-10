// document.addEventListener("DOMContentLoaded", () => {
//   const deleteButtons = document.querySelectorAll(".btn-delete");
//   const confirmDelete = document.getElementById("confirm-delete");

//   deleteButtons.forEach((button) => {
//     button.addEventListener("click", () => {
//       const userid = button.getAttribute("data-id");

//       confirmDelete.setAttribute("href", `?page=delete&userid=${userid}`);
//       console.log("userid");
//     });
//   });
// });

const buttonsDitils = document.querySelectorAll(".btn-detilis");
const showId = document.getElementById("show_id");

buttonsDitils.forEach((button) => {
  button.addEventListener("click", () => {
    const userid = button.getAttribute("data-userid");
    showId.value = userid;

    history.pushState(null, "", "?user_id=" + userid);

    const modal = new bootstrap.Modal(document.getElementById("detailsModal"));
    modal.show();

    fetchUserData(userid);
  });
});

function fetchUserData(id) {
  fetch("includes/api/get_user.php?user_id=" + id)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("userDetails").innerHTML = `
      <p> id : <strong>${data.id}</strong> </p>
      <p> username : <strong>${data.username}</strong> </p>
      <p> email : <strong>${data.email}</strong> </p>
      <p> status : <strong>${data.status}</strong> </p>
      <p> role : <strong>${data.role}</strong> </p>
      <p> created_at : <strong>${data.created_at}</strong> </p>
      `;

      console.log(data.email);
    })
    .catch((error) => console.error("حدث خطأ في الطلب:", error));
}
