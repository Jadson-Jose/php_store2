<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">
            <div>
                <h3 class="text-center">LOGIN</h3>

                <form action="?a=login_submit" method="post">

                    <div class="my-3">
                        <label>Usuário:</label>
                        <input type="email" name="text_usuario" placeholder="Usuário" class="form-control">
                    </div>

                    <div class="my-3">
                        <label>Senha:</label>
                        <input type="password" name="text_senha" placeholder="Senha" class="form-control" required>
                    </div>

                    <div class="my-3">
                        <input type="submit" value="Entrar" class="btn btn-primary" required>
                    </div>

                    <?php if (!isset($_SESSION['erro'])) : ?>
                        <div class="alert alert-danger text-center">
                            <?= $_SESSION['erro'] ?>
                        </div>
                    <?php endif; ?>

                </form>

            </div>
        </div>
    </div>
</div>