$(document).ready(function () {
  const $thead = $("thead tr th").length;

  $("#dataTable").DataTable({
    processing: true,
    oLanguage: {
      sLengthMenu: "Tampilkan _MENU_ data per halaman",
      sSearch: "Pencarian: ",
      sZeroRecords: "Maaf, tidak ada data yang ditemukan",
      sInfo: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
      sInfoEmpty: "Menampilkan 0 s/d 0 dari 0 data",
      sInfoFiltered: "(di filter dari _MAX_ total data)",
      // oPaginate: {
      //   sFirst: "<<",
      //   slast: ">>",
      //   sPrevious: "<",
      //   sNext: ">",
      // },
    },
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search...",
    },
    columnDefs: [
      {
        orderable: false,
        targets: $thead == 4 ? [] : [4],
      },
      {
        className: "wrap-max-30",
        targets: [0],
      },
      {
        className: "wrap-max-20",
        targets: [1, 2, 3],
      },
      {
        className: "wrap-max-10 dt-nowrap",
        targets: [4],
      },
    ],
    // ordering: true,
    // info: true,
    serverSide: true,
    responsive: true,
    // stateSave: true,
    scrollX: true,
    ajax: {
      url: base_url + "/utilities/listdata_employees",
      type: "get",
      error: function (e) {
        console.log("data tidak ditemukan di server");
      },
      // success: function (data) {
      //   console.log(data);
      // },
    },
    columns: [
      { data: "employee_name", name: "employee_name" },
      { data: "nip", name: "nip" },
      { data: "position_name", name: "position_name" },
      { data: "department_name", name: "department_name" },
      { data: "action", name: "action" },
    ],
  });
});
