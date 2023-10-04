<div class="people-movie-container">
        <h1 id="known-for" class="text">
            KNOWN FOR:
        </h1>
        <div class="row">
            <?php $count = 0; ?>
            <?php foreach ($this->data['images'] as $movieName => $imagePath): ?>
                <div class="picture">
                    <a href="movie"> 
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo $movieName; ?>">
                    </a>
                </div>
                <?php $count++; ?>
                <?php if ($count % 3 === 0): ?>
                    </div>
                    <?php if ($count < count($this->data['images'])): ?>
                        <div class="row"> 
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>