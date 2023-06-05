// script untuk buat ambil id di ubah data
$(document).on("click", "#btn-edit", function () {
  $(".modal-body #id").val($(this).data("id"));
  $(".modal-body #nisn").val($(this).data("nisn"));
  $(".modal-body #nama").val($(this).data("nama"));
});

// script untuk mengambil id di hapus data
$(document).on("click", "#btn-hapus", function () {
  $(".modal-body #id").val($(this).data("id"));
  $(".modal-body #nisn").val($(this).data("nisn"));
  $(".modal-body #nama").val($(this).data("nama"));
});
