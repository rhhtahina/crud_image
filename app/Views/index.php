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
                            <input type="text" name="title" class="form-control" placeholder="title" required>
                            <div class="invalid-feedback">Post title is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Category</label>
                            <input type="text" name="category" class="form-control" placeholder="category" required>
                            <div class="invalid-feedback">Post category is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Body</label>
                            <textarea name="body" class="form-control" rows="4" placeholder="Body" required></textarea>
                            <div class="invalid-feedback">Post body is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Image</label>
                            <input type="file" name="file" id="image" class="form-control" required>
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

    <!-- edit post modal start -->
    <div class="modal fade" id="edit_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                    <input type="hidden" name="id" id="pid">
                    <input type="hidden" name="old_image" id="old_image">
                    <div class="modal-body p-5">
                        <div class="mb-3">
                            <label>Post Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="title"
                                required>
                            <div class="invalid-feedback">Post title is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Category</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="category"
                                required>
                            <div class="invalid-feedback">Post category is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Body</label>
                            <textarea name="body" class="form-control" rows="4" id="body" placeholder="Body"
                                required></textarea>
                            <div class="invalid-feedback">Post body is required!</div>
                        </div>
                        <div class="mb-3">
                            <label>Post Image</label>
                            <input type="file" name="file" class="form-control">
                            <div class="invalid-feedback">Post image is required!</div>
                            <div id="post_image"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="edit_post_btn">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit post modal end -->

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
                            <h1 class="text-center text-secondary my-5">Posts Loading...</h1>
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
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            $("#image").addClass('is-invalid');
                            $("#image").next().text(response.message.image);
                        } else {
                            $("#add_post_modal").modal('hide');
                            $("#add_post_form")[0].reset();

                            $("#image").removeClass('is-invalid');
                            $("#image").next().text('');
                            $("#add_post_form").removeClass('was-validated');
                            Swal.fire(
                                'Added',
                                response.message,
                                'success'
                            );
                            fetchAllPosts();
                        }
                        $("#add_post_btn").text("Add Post");
                    }
                });
            }
        });

        // fetch all posts ajax request
        fetchAllPosts();

        function fetchAllPosts() {
            $.ajax({
                type: "get",
                url: "<?= base_url('post/fetch') ?>",
                success: function(response) {
                    $("#show_posts").html(response.message);
                }
            });
        }
    });
    </script>
</body>

</html>