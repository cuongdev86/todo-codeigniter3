<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-title-container">
            <h2 class="mb-2 page-title">Works</h2>
            <a class="btn-add-new" href="<?= base_url() ?>works/create"><i class="fe fe-folder-plus"></i> Add New</a>
        </div>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">

                <div class="row mb-3">
                    <div class="col-md-3">
                        <input id="searchNameUrl" type="text" class="form-control" placeholder="Search by name..." style="border-radius: 0px;">
                    </div>
                    <div class="col-md-3">
                        <input id="searchDescriptionUrl" type="text" class="form-control" placeholder="Search by description..." style="border-radius: 0px;">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" id="btnSearch" onclick="searchByButton()">Search</button>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <div class="col-md-12">
                        <a class="btn btn-primary"> <i class="fe fe-upload"></i> Import Excel</a>
                        <a class="btn btn-success" href="javascript:void(0)" onclick="exportExcel();"> <i class="fe fe-download"></i> Export Excel</a>

                    </div>
                </div> -->

                <div class="row mb-3">
                    <div class="col-md-12 d-flex">
                        <form action="<?= base_url() ?>works/imports" method="post" enctype="multipart/form-data" id="importForm">
                            <input type="file" name="excel_file" accept=".xlsx, .xls, .csv" id="excel_file" style="display: none;" />
                            <a class="btn btn-primary" onclick="document.getElementById('excel_file').click();"> <i class="fe fe-upload"></i> Import Excel</a>
                        </form>
                        <a class="btn btn-success ml-2" style="border: none;" href="javascript:void(0)" onclick="exportExcel();"> <i class="fe fe-download"></i> Export Excel</a>
                        <a class="btn btn-danger ml-2" href="javascript:void(0)" onclick="actionDeletes();"> <i class="fe fe-trash"></i> Delete</a>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <table class="table datatables" id="workDatatable">
                            <thead>
                                <tr>
                                    <th style="width: 8%;"><input type="checkbox" value="" id="checkboxAll" class="checkboxAll"></th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="width: 12%;">Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div> <!-- simple table -->
        </div> <!-- end section -->
    </div> <!-- .col-12 -->
</div> <!-- .row -->

<script>
    function datatableCallAjax(searchNameUrl = null, searchDescriptionUrl = null) {
        var columns = [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return `<input type="checkbox" class="checkItem" onclick="checkItem('${data}', this)" id="checkboxId-${data}">`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'description'
            },
            {
                data: 'file_base64',
                render: function(data, type, row, meta) {
                    return '<img src="' + data + '" style="width: 100%" />';
                }
            },
            {
                data: 'action',
                render: function(data, type, row, meta) {
                    return `<button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                        </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= base_url() ?>works/edit/${data.id}">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="removeItem(${data.id}, '${data.name}')">Remove</a>
                            </div>`;
                }
            }

        ];
        if (!$.fn.dataTable.isDataTable('#workDatatable')) {
            table = $('#workDatatable').DataTable({
                ajax: {
                    url: '<?= base_url() ?>works/datatable',
                    type: 'GET',
                    data: function(d) {
                        if (d.length === -1) {
                            d.length = table.data().count();
                        }
                    }
                },
                columns: columns,
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }],
                processing: true,
                serverSide: true,
                lengthMenu: [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ],
                dom: "Blrtip" // B - Button, f - Filter, r - Processing, t - Table, i - Info, p - Pagination
            });
        } else {
            table.ajax.url('<?= base_url() ?>works/datatable?searchNameUrl=' + searchNameUrl + '&searchDescriptionUrl=' + searchDescriptionUrl).load();
        }
    }
    $(document).ready(function() {
        datatableCallAjax();
    });

    function searchByButton() {
        let searchNameUrl = $('#searchNameUrl').val();
        let searchDescriptionUrl = $('#searchDescriptionUrl').val();
        console.log(searchNameUrl, searchDescriptionUrl);

        // table.ajax.url('<?= base_url() ?>works/datatable').load();
        datatableCallAjax(searchNameUrl, searchDescriptionUrl);
    }

    function removeItem(id, name) {
        Swal.fire({
            title: "Do you want to delete " + name + "?",
            width: 500,
            showDenyButton: true,
            confirmButtonText: "Delete",
            denyButtonText: `Cancel`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url() ?>' + 'works/delete/' + id;
            }
        });
    }

    function getCurrentFilters() {
        var filters = {};

        // Get global search value
        filters.globalSearch = table.search();

        // Get column search values
        filters.columnSearch = [];
        table.columns().every(function(index) {
            filters.columnSearch[index] = this.search();
        });

        // Get current sort order
        filters.order = table.order();

        // Get current page info
        var pageInfo = table.page.info();
        filters.page = pageInfo.page;
        filters.recordsDisplay = pageInfo.recordsDisplay;
        filters.recordsTotal = pageInfo.recordsTotal;

        // Get current page length
        filters.pageLength = table.page.len();

        return filters;
    }


    document.getElementById('excel_file').onchange = function() {
        // document.getElementById('importForm').submit();
        Swal.fire({
            title: "Do you want to import this file?",
            width: 500,
            showDenyButton: true,
            confirmButtonText: "Upload",
            denyButtonText: `Cancel`
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('importForm').submit();
            }
        });
    };

    var arrayId = [];
    $(function() {

        $("#checkboxAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
            if (this.checked) {
                $('.checkItem').each(function(index, item) {
                    let id = item.id.slice(11);
                    if (!arrayId.includes(id)) {
                        arrayId.push(id);
                    }
                });
            } else {
                arrayId = [];
            }
            console.log(arrayId);


        });



    });

    function checkItem(id, item) {
        if (item.checked) {
            if (!arrayId.includes(id)) {
                arrayId.push(id);
            }
        } else {
            if (arrayId.includes(id)) {
                arrayId = arrayId.filter(filter => filter !== id);
            }
        }
        console.log(arrayId);
    }

    function actionDeletes() {
        if (arrayId.length > 0) {
            Swal.fire({
                title: "Do you want to delete items selected?",
                width: 500,
                showDenyButton: true,
                confirmButtonText: "Delete",
                denyButtonText: `Cancel`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>works/deletes',
                        type: 'get',
                        data: {
                            ids: arrayId
                        },
                        success: function(response) {

                            let data = JSON.parse(response);
                            if (data.result) {
                                Swal.fire('Deleted!', data.message, 'success').then((res) => {
                                    window.location.reload();
                                });

                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }

                        }
                    });
                }
            });
        }
    }

    function exportExcel() {
        var filters = getCurrentFilters();
        let searchbyName = $('#searchNameUrl').val();
        let searchbyDescription = $('#searchDescriptionUrl').val();
        let sortByName = filters.order[0][0] == 0 ? filters.order[0][1] : '';
        let sortByDescription = filters.order[0][0] == 1 ? filters.order[0][1] : '';
        // console.log(filters.order[0]);
        let ids = arrayId;
        window.location.href = '<?= base_url() ?>works/exports?searchbyName=' + searchbyName + '&searchbyDescription=' + searchbyDescription + '&sortByName=' + sortByName + '&sortByDescription=' + sortByDescription + '&ids=' + ids;
    }
</script>