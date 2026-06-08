<div class="container">
    <form action="?controller=UsuariosController&<?php echo isset($usuario->id) ? "method=atualizar&id={$usuario->id}" : "method=salvar"; ?>" method="post">

        <div class="card" style="top:40px">

            <div class="card-header">
                <span class="card-title">Usuários</span>
            </div>

            <div class="card-body"></div>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome:</label>
                <input type="text"
                       class="form-control col-sm-8"
                       name="nome"
                       value="<?php echo isset($usuario->nome) ? $usuario->nome : null; ?>" />
            </div>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Email:</label>
                <input type="text"
                       class="form-control col-sm-8"
                       name="email"
                       value="<?php echo isset($usuario->email) ? $usuario->email : null; ?>" />
            </div>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Senha:</label>
                <input type="password"
                       class="form-control col-sm-8"
                       name="senha"/>
            </div>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Ativo:</label>

                <select class="form-control col-sm-8" name="ativo">
                    <option value="1"
                        <?php echo (isset($usuario->ativo) && $usuario->ativo == 1) ? 'selected' : ''; ?>>
                        Sim
                    </option>

                    <option value="0"
                        <?php echo (isset($usuario->ativo) && $usuario->ativo == 0) ? 'selected' : ''; ?>>
                        Não
                    </option>
                </select>
            </div>

            <div class="card-footer">
                <input type="hidden"
                       name="id"
                       value="<?php echo isset($usuario->id) ? $usuario->id : null; ?>" />

                <button class="btn btn-success" type="submit">Salvar</button>

                <a class="btn btn-danger"
                   href="?controller=UsuariosController&method=listar">
                    Cancelar
                </a>
            </div>

        </div>

    </form>
</div>