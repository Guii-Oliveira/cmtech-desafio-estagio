<?php if (isset($_GET['erro'])): ?>
    <div class="alert alert-danger">
        Email ou senha inválidos!
    </div>
<?php endif; ?>
<div class="container">
    <form action="?controller=LoginController&method=autenticar" method="post">

        <div class="card" style="top:40px">

            <div class="card-header">
                <span class="card-title">Login</span>
            </div>

            <div class="card-body">

                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">
                        Email:
                    </label>

                    <input
                        type="email"
                        class="form-control col-sm-8"
                        name="email"
                        id="email"
                        required
                    />
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">
                        Senha:
                    </label>

                    <input
                        type="password"
                        class="form-control col-sm-8"
                        name="senha"
                        id="senha"
                        required
                    />
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-success" type="submit">
                    Entrar
                </button>
            </div>

        </div>

    </form>
</div>