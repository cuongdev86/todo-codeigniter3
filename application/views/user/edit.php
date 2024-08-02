<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-title-container">
            <h2 class="mb-2 page-title">User edit</h2>

        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?= base_url() ?>users/update/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="inputName" class="label-required">Name</label>
                                <input type="text" name="name" value="<?= $user['name'] ?>" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputUn" class="label-required">Username</label>
                                <input type="text" name="username" value="<?= $user['username'] ?>" id="inputUn" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputEmail" class="label-required">Email</label>
                                <input type="email" name="email" value="<?= $user['email'] ?>" id="inputEmail" class="form-control" required>
                            </div>
                            <button class="btn btn-primary float-right"><i class="fe fe-save"></i> Save</button>
                        </div> <!-- /.col -->

                    </div>
                </form>
            </div>
        </div> <!-- / .card -->

    </div> <!-- .col-12 -->
</div> <!-- .row -->