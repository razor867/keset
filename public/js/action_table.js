function deleteData(page, id) {
  let link = "";
  if (page == "_dat_asset_types") {
    link = base_url + "/utilities/delete_asset_types/" + id;
  } else if (page == "_dat_main_assets") {
    link = base_url + "/assets/delete_main_assets/" + id;
  } else if (page == "_dat_consumables") {
    link = base_url + "/assets/delete_consumables/" + id;
  }

  Swal.fire({
    title: "Yakin hapus data ini?",
    text: "Kamu tidak akan melihatnya lagi!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = link;
    }
  });
}
