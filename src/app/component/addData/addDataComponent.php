<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/addData/addData.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/tag.css">
    
    <script type="text/javascript" src="/js/others/debounce.js" defer></script>
    
    <?php if ($this->data["datatype"]== 'movies') : ?>
        <link rel="stylesheet" type="text/css" href="/styles/addData/addMovie.css">
        <script type="text/javascript" src="/js/addData/addMovie.js" defer></script>
    <?php elseif ($this->data["datatype"]== 'director' || $this->data["datatype"]== 'actor'): ?>
        <script type="text/javascript" src="/js/addData/addPeople.js" defer></script>
    <?php endif; ?>
    
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