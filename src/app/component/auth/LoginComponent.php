<form class="login">
    <h1 class="auth-title">
        Selamat Datang Kembali!
    </h1>
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-input" id="username" name="username" type="text" placeholder="Username" />
        <!-- <? if (isset($this->data["errors"])) :?>
            <span class="error"><?= $this->data["errors"]["email"] ?></span>
        <? endif ?> -->
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-input" id="password" name="password" type="password" placeholder="Password"/>
    </div>
    <button class="btn btn-primary" type="submit">Masuk</button>
</form>

<div class="register-btn">
    <a href="/auth/register" class="btn alt-btn">Register</a>
</div>
