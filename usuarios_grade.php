<?php
$usuarios = $usuarios ?? [];
?>
<h1>Usuários</h1>
<hr>

<div class="container">
    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ativo</th>
                <th>
                    <a href="?controller=UsuariosController&method=criar"
                       class="btn btn-success btn-sm">
                        Novo
                    </a>
                </th>
            </tr>
        </thead>

        <tbody>

            <?php
            if ($usuarios) {
                foreach ($usuarios as $usuario) {
            ?>

                <tr>
                    <td><?php echo $usuario->nome; ?></td>
                    <td><?php echo $usuario->email; ?></td>
                    <td><?php echo $usuario->ativo; ?></td>

                    <td>
                        <a href="?controller=UsuariosController&method=editar&id=<?php echo $usuario->id; ?>"
                           class="btn btn-primary btn-sm">
                            Editar
                        </a>

                        <a href="?controller=UsuariosController&method=excluir&id=<?php echo $usuario->id; ?>"
                           class="btn btn-danger btn-sm">
                            Excluir
                        </a>
                    </td>
                </tr>

            <?php
                }
            } else {
            ?>

                <tr>
                    <td colspan="4">
                        Nenhum usuário encontrado
                    </td>
                </tr>

            <?php
            }
            ?>

        </tbody>

    </table>
</div>