<div class="option-<?= $type ?>-tag option-tag" 
data="<?php 
    if($type == "actor") {
        echo $movie_actor['actor_id'];
    } else {
        echo $movie_director['director_id'];
    }
?>">
    <div class="option-name">

        <p>
            <?php 
                if($type == "actor") {
                    echo $actors[$movie_actor['actor_id']]['name'];
                } else {
                    echo $directors[$movie_director['director_id']]['name'];
                }
            ?>

        </p>
    </div>
    <a id="delete-<?= $type ?>-tag" data="<?= $movie_actor['actor_id'] ?>" onclick="deleteTagHandler(this, '<?= $type ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
        </svg>
    </a>
</div>