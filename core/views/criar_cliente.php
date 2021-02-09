<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Registro de clientes</h3>

            <form action="?a=criar_cliente" method="post">

                <!-- eamil -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email" placeholder="Email" class="form-control" required>
                </div>

                <!-- senha_1 -->
                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" required>
                </div>

                <!-- Senha_2 -->
                <div class="my-3">
                    <label>Repetir Senha</label>
                    <input type="password" name="text_senha_2" placeholder="Repita a senha" class="form-control" required>
                </div>

                <!-- Nome completo -->
                <div class="my-3">
                    <label>Nome completo</label>
                    <input type="text" name="text_nome_completo" placeholder="Nome completo" class="form-control" required>
                </div>

                <!-- Endereço -->
                <div class="my-3">
                    <label>Endereço</label>
                    <input type="text" name="text_endereco" placeholder="Endereço" class="form-control" required>
                </div>

                <!-- Cidade -->
                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade" placeholder="cidade" class="form-control" required>
                </div>

                <!-- Telefone -->
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone" placeholder="telefone" class="form-control">
                </div>

                <!-- Submit -->
                <div class="my-4">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>

                <?php if (isset($_SESSION['erro'])) : ?>
                    <div class="alert alert-danger text-center p-2">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif; ?>
            </form>

        </div>
    </div>
</div>