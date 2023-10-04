<form method="post" class="login" novalidate>
    <h1 class="auth-title">
        Selamat Datang Kembali!
    </h1>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-input" name="email" type="email" placeholder="Email" />
        <!-- <? if (isset($this->data["errors"])) :?>
            <span class="error"><?= $this->data["errors"]["email"] ?></span>
        <? endif ?> -->
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-input" name="password" type="password" placeholder="Password"/>
    </div>
    <button class="btn btn-primary">Masuk</button>
</form>

<div class="register-btn">
    <a href="/auth/register" class="btn alt-btn">Register</a>
</div>
