<nav class="navbar">
    <ul class="navbar-list">
        <li class="left-navbar">
            <a href="/public/home" class="navbar-component">Home</a>
        </li>
        <li class="left-navbar">
            <a href="/public/home" class="navbar-component">Movies</a>
        </li>
        <li class="left-navbar">
            <a href="/public/directors" class="navbar-component">Directors</a>
        </li>
        <li class="left-navbar">
            <a href="/public/actors" class="navbar-component">Actors</a>
        </li>
        <li class="left-navbar">
            <a href="/public/ratings" class="navbar-component">Ratings</a>
        </li>
        <li class="left-navbar">
            <a href="/public/search" class="navbar-component">Search</a>
        </li>
        <?php if ($this->data['username']) : ?>
        <li class="right-navbar">
            <a href="/public/user" class="navbar-component"><?= $this->data['username'] ?></a>
        </li>
        <?php else : ?>
        <li class="right-navbar">
            <a href="/public/user" class="navbar-component">Login</a>
        </li>
        <li class="right-navbar">
            <a href="/public/user" class="navbar-component">Register</a>
        </li>
        <?php endif; ?> 
    </ul>
</nav>