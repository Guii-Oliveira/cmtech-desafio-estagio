<?php


class Usuario
{
    private $atributos;

    public function __construct()
    {

    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    /**
     * Salvar o usuario
     * @return boolean
     */
   public function save()
{
    try {
        $colunas = $this->preparar($this->atributos);
        $conexao = Conexao::getInstance();

        if (!isset($this->id)) {
            $query = "INSERT INTO usuarios (" .
                implode(', ', array_keys($colunas)) .
                ") VALUES (" .
                implode(', ', array_values($colunas)) .
                ")";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id') {
                    $definir[] = "{$key}={$value}";
                }
            }

            $query = "UPDATE usuarios SET " .
                implode(', ', $definir) .
                " WHERE id='{$this->id}'";
        }

        $stmt = $conexao->prepare($query);
        return $stmt->execute();

    } catch (PDOException $e) {
        error_log("Erro em Usuario::save: " . $e->getMessage());
        return false;
    }
}

    /**
     * Tornar valores aceitos para sintaxe SQL
     * @param type $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }

    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }

    /**
     * Retorna uma lista de usuarios
     * @return array/boolean
     */
    public static function all()
{
    try {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare(
            "SELECT * FROM usuarios WHERE excluido = 0"
        );

        $stmt->execute();

        $result = [];

        while ($rs = $stmt->fetchObject(Usuario::class)) {
            $result[] = $rs;
        }

        return count($result) > 0 ? $result : false;

    } catch (PDOException $e) {
        error_log("Erro em Usuario::all: " . $e->getMessage());
        return false;
    }
}

    /**
     * Retornar o número de registros
     * @return int/boolean
     */
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM usuarios;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }

    /**
     * Encontra um recurso pelo id
     * @param type $id
     * @return type
     */
    public static function find($id)
{
    $conexao = Conexao::getInstance();

    $stmt = $conexao->prepare(
        "SELECT * FROM usuarios 
         WHERE id = :id 
         AND excluido = 0"
    );

    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetchObject('Usuario');
    }

    return false;
}
   public static function findByEmail($email)
{
    try {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare(
            "SELECT * FROM usuarios 
             WHERE email = :email 
             AND ativo = 1 
             AND excluido = 0"
        );

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetchObject('Usuario') ?: false;

    } catch (PDOException $e) {
        error_log("Erro em findByEmail: " . $e->getMessage());
        return false;
    }
}
    /**
     * Destruir um recurso
     * @param type $id
     * @return boolean
     */
  public static function destroy($id)
{
    $conexao = Conexao::getInstance();

    $stmt = $conexao->prepare(
        "UPDATE usuarios 
         SET excluido = 1 
         WHERE id = :id"
    );

    $stmt->bindValue(':id', $id);

    return $stmt->execute();
}
}
