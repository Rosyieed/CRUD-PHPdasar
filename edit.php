<?php
if (isset($_GET['id'])) {
    include "koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM articles WHERE
id='$id'");
    $data = mysqli_fetch_array($query);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initialscale=1.0">
        <title>Edit</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_GET['message'])) {
                        $message = $_GET['message'];
                    ?>
                        <div class="alert alert-danger my-4"><?= $message ?></div>
                    <?php
                    }
                    ?>
                    <div class="card border-0">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h2>Edit Article</h2>
                                <a href="index.php" class="btn btn-primary">List Articles</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="edit-process.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="mb-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?= $data['title'] ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea name="content" id="content" class="form-control"><?=
                                                                                                $data['content'] ?></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="Programming" <?= $data['category'] == "Programming" ?
                                                                        "Selected" : "" ?>>Programming</option>
                                        <option value="Business" <?= $data['category'] == "Business" ?
                                                                        "Selected" : "" ?>>Business</option>
                                        <option value="News" <?= $data['category'] == "News" ? "Selected" :
                                                                    "" ?>>News</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="thumbnail" class="Thumbnail">Thumbnail</label>
                                    <br>
                                    <img src="images/<?= $data['thumbnail'] ?>" class="img-fluid imgthumbnail my-3" width="100">
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                </div>
                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>