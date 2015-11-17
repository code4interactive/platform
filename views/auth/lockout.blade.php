
<div class="lock-word animated fadeInDown">
    <span class="first-word">LOCKED</span><span>SCREEN</span>
</div>
<div class="middle-box text-center lockscreen animated fadeInDown">
    <div>
        <div class="m-b-md">
            <?php
                $gravatar_src = \Gravatar::src($user->email, 128);
                echo '<img src="' . $gravatar_src . '" class="img-circle">';
            ?>
        </div>
        <h3>{!! $user->getFirstAndLastName() !!}</h3>
        <p>Ekran został zablokowany. Aby kontynuować wprowadź hasło w polu poniżej.</p>
        <form class="m-t ajax" role="form" method="post" action="/lockout">
            <div class="form-group">
                <input type="hidden" name="email" value="{!! $user->email !!}" />
                <input type="password" name="password" class="form-control" placeholder="******" required="">
            </div>
            <p class="text-center"><button type="submit" class="btn btn-primary block full-width">Odblokuj ekran</button></p>
        </form>
        <p class="text-center">Jeżeli chcesz zalogować się na inne konto skorzystaj <br>z przycisku poniżej.</p>
        <p class="text-center"><a href="/login" class="btn btn-sm btn-white btn-block full-width">Zaloguj się na inne konto</a></p>
    </div>
</div>