<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/addData/addData.css">
</head>

<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="auth-container">
        
        <div class="addData-form-container">
            <!-- <? print_r($this->data) ?> -->
            <? if ($this->data["datatype"]== 'movies') {
                include(dirname(__DIR__) . '/addData/addMovieComponent.php');
                // print_r($this->data); 
            } else if ($this->data["datatype"]== 'director') {
                include(dirname(__DIR__) . '/addData/addDirectorComponent.php');
            } else if ($this->data["datatype"]== 'actor') {
                include(dirname(__DIR__) . '/addData/addActorComponent.php');
            } ?>
        </div>
    </div>

</body>

</html>