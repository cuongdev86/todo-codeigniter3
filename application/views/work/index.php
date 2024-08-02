<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-title-container">
            <h2 class="mb-2 page-title">Works</h2>
            <a class="btn-add-new" href="<?= base_url() ?>works/create"><i class="fe fe-folder-plus"></i> Add New</a>
        </div>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <table class="table datatables" id="dataTable-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="width: 12%;">Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($works as $key => $work) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $work['name'] ?></td>
                                        <td><?= $work['description'] ?></td>
                                        <td><img style="width: 100%;" src="<?= base_url() . $work['file'] ?>" alt="<?= $work['name'] ?>"></td>
                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?= base_url() ?>works/edit/<?= $work['id'] ?>">Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="removeItem(<?= $work['id'] ?>, '<?= $work['name'] ?>')">Remove</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- simple table -->
        </div> <!-- end section -->
    </div> <!-- .col-12 -->
</div> <!-- .row -->

<script>
    function removeItem(id, workname) {
        Swal.fire({
            title: "Do you want to delete " + workname + "?",
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
</script>