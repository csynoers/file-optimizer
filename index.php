<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

    <title>Image Optimizer</title>
  </head>
    <body>
        <div class="container">
            <div class="col-12 pt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="optimize.php" method="post" enctype="multipart/form-data" >
                            <h1><span>Select your images (.JPG, .JPEG , .PNG AND .GIF):</span></h1>
                            <div class="form-file mb-3">
                                <input type="file" class="form-file-input" id="customFileLong" name="files[]" multiple required>
                                <label class="form-file-label" for="customFileLong">
                                    <span class="form-file-text">Choose file...</span>
                                    <span class="form-file-button">Browse</span>
                                </label>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="width" class="form-control" placeholder="width your image after optimize" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">px</span>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Optimize</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
                <?php
                if ( !empty($_GET['q']) ) {
                    $files = array_diff(scandir('./uploads',1), array('..', '.'));
                    foreach ($files as $key => $value) {
                        echo "
                            <div class='col'>
                                <div class='card'>
                                    <img src='uploads/{$value}' class='card-img-top img-fluid' alt='...'>
                                    <div class='card-body'>
                                    <h5 class='card-title'>{$value}</h5>
                                    <!--<p class='card-text'>This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper.js and Bootstrap JS
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
    -->
  </body>
</html>