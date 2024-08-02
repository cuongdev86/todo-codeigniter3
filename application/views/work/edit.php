<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-title-container">
            <h2 class="mb-2 page-title">Edit work</h2>

        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?= base_url() ?>works/update/<?= $work['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="inputName" class="label-required">Name</label>
                                <input type="text" name="name" value="<?= $work['name'] ?>" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputDes">Description</label>
                                <textarea name="description" id="inputDes" class="form-control" rows="5"><?= $work['description'] ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputFile">File</label>
                                <input type="file" name="file" id="inputFile" class="form-control-file">
                                <img class="mt-2" style="width: 80px" src="<?= base_url() . $work['file'] ?>" alt="<?= $work['name'] ?>">
                            </div>

                            <button class="btn btn-primary float-right"><i class="fe fe-save"></i> Save</button>
                        </div> <!-- /.col -->

                    </div>
                </form>
            </div>
        </div> <!-- / .card -->

    </div> <!-- .col-12 -->
</div> <!-- .row -->