<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Project Description" />
        <meta name="author" content="Project Author" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>TP2 - Forum de discussion</title>
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" />
    </head>
    <body class="bg-light">
        <div class="container col-md-6 my-3">
            <form class="mb-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                <div class="row mb-3">
                    <label for="firstname" class="col-sm-4 col-form-label"><i class="fas fa-user-circle me-1"></i> Nom <sup class="fw-bold text-danger">*</sup></label>
                    <div class="col-sm-8">
                        <input type="text" id="firstname" class="form-control" name="firstname" value="" autofocus required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lastname" class="col-sm-4 col-form-label"><i class="fas fa-user me-1"></i> Prenom <sup class="fw-bold text-danger">*</sup></label>
                    <div class="col-sm-8">
                        <input type="text" id="lastname" class="form-control" name="lastname" value="" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-4 col-form-label"><i class="fas fa-at me-1"></i> Email <sup class="fw-bold text-danger">*</sup></label>
                    <div class="col-sm-8">
                        <input type="email" id="email" class="form-control" name="email" value="" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="city" class="col-sm-4 col-form-label"><i class="fas fa-building me-1"></i> Ville <sup class="fw-bold text-danger">*</sup></label>
                    <div class="col-sm-8">
                        <input type="text" id="city" class="form-control" name="city" value="" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="country" class="col-sm-4 col-form-label"><i class="fas fa-flag me-1"></i> Pays <sup class="fw-bold text-danger">*</sup></label>
                    <div class="col-sm-8">
                        <input type="text" id="country" class="form-control" name="country" value="" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="message" class="col-sm-4 col-form-label"><i class="fas fa-envelope me-1"></i> Message <sup class="fw-bold text-danger">*</sup></label>
                    <div class="col-sm-8">
                        <textarea id="message" class="form-control" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="file" class="col-sm-4 col-form-label"><i class="fas fa-file me-1"></i> joindre un fichier</label>
                    <div class="col-sm-8">
                        <input type="file" id="file" class="form-control" name="file" required />
                    </div>
                </div>
                <hr />
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-lg btn-primary" name="submit">Envoyer <i class="fas fa-arrow-alt-circle-right ms-1"></i></button>
                </div>
            </form>
			

<?php
$filename = "data_form.txt";
$time = date("Y-d-m H:m:s");
if (isset($_POST["submit"])) {
    $data = [
        "firstname" => $_POST["firstname"],
        "lastname" => $_POST["lastname"],
        "email" => $_POST["email"],
        "city" => $_POST["city"],
        "country" => $_POST["country"],
        "message" => $_POST["message"],
    ];

    //now append to the existing JSON, if any
    $existingJSON = file_get_contents($filename);
    $list = [];

    if ($existingJSON !== false) {
        $list = json_decode($existingJSON, true);
    }
    $list[] = $data; //append to the list
    $json = json_encode($list);
    file_put_contents($filename, $json);
}

$fileJSON = file_get_contents($filename);
$fileList = json_decode($fileJSON, true);

if (is_array($fileList) || is_object($fileList)) {
    foreach ($fileList as $item) {
        echo "
            <ul class='list-group'>
                <li class='row row-cols-1 row-cols-md-2 p-4 bg-white shadow'>
                    <div class='col mb-lg-0 mb-md-4'>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item bg-transparent px-0'><i class='fas fa-user-circle me-1'></i> <strong>Nom &amp; Prénom:</strong> <span class='text-primary'>" .
            $item["firstname"] .
            " " .
            $item["lastname"] .
            "</span></li>
                            <li class='list-group-item bg-transparent px-0'>
                                <i class='fas fa-envelope me-1'></i>
                                <strong>Message:</strong>
                                <span><i class='fas fa-clock'></i> " .
            $time .
            "</span>
                                <br />
                                <p>" .
            $item["message"] .
            "</p>
                            </li>
                        </ul>
                    </div>
                    <div class='col'>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item bg-transparent px-0'><i class='fas fa-building me-1'></i> <strong>Ville:</strong> <span class='text-primary'>" .
            $item["city"] .
            " " .
            $item["country"] .
            "</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            ";
        echo "<br>";
    }
}
?>


			
        </div>
        <!-- JS Libraries -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>