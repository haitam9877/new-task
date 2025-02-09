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

document.addEventListener("DOMContentLoaded", () => {
  const buttonsDitils = document.querySelectorAll(".btn-detilis");
  const showId = document.getElementById("show_id");

  buttonsDitils.forEach((button) => {
    button.addEventListener("click", () => {
      const userid = button.getAttribute("data-userid");
      showId.setAttribute("value", userid);

      console.log(showId);
    });
  });
});
