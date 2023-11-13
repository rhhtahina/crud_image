<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App Using CI 4 and Ajax</title>
    <link href="<?= base_url() ?>assets/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- add new post modal start -->
    <div class="modal fade" id="add_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                    <div class="modal-body p-5">
                        <div class="mb-3">
                            <label>Post Title</label>
                            <input type="text" name="category" class="form-control" placeholder="category" required>
                            <div class="invalid-feedback">Post category is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Category</label>
                            <input type="text" name="title" class="form-control" placeholder="title" required>
                            <div class="invalid-feedback">Post title is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Body</label>
                            <textarea name="body" class="form-control" rows="4" placeholder="Body" required></textarea>
                            <div class="invalid-feedback">Post body is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                            <div class="invalid-feedback">Post image is required!</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add_post_btn">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new post modal end -->

    <div class="container">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card shadow">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="text-secondary fw-bold fs-3">All Posts</div>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#add_post_modal">Add New
                            Post</button>
                    </div>
                    <div class="card-body">
                        <div class="row" id="show_posts">
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <a href="#"><img
                                            src="https://www.lifewire.com/thmb/T7a6QlzUPEpua3OKx7V_pCvBY14=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/forest-wallpaper-af78609605b14f7c9b999d8b2f49c0d9.jpg"
                                            class="img-gluid card-img-top"></a>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="card-title fs-5 fw-bold">Post Title</div>
                                            <div class="badge bg-dark">Category</div>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <div class="fst-italic">
                                            21-12-2021
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-success btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

    </div>
    <script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/sweetalert2@11.js"></script>
    <script>
    $(document).ready(function() {
        // add new post ajax request
        $("#add_post_form").submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            if (!this.checkValidity()) {
                e.preventDefault();
                $(this).addClass('was-validated');
            } else {
                $("#add_post_btn").text("Adding...");
                $.ajax({
                    type: "post",
                    url: "<?= base_url('post/add') ?>",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    });
    </script>
</body>

</html>