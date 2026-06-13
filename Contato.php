<?php


class Contato
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
     * Salvar o contato
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->id)) {
            $query = "INSERT INTO contatos (".
                implode(', ', array_keys($colunas)).
                ") VALUES (".
                implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE contatos SET ".implode(', ', $definir)." WHERE id='{$this->id}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }

    /**
     * Tornar valores aceitos para sintaxe SQL
     * @param type $dados
     * @return string
     */
    private function escapar(mixed $dados): string
{
    if (is_string($dados) && !empty($dados)) {
        return "'" . addslashes($dados) . "'";
    }

    if (is_bool($dados)) {
        return $dados ? 'TRUE' : 'FALSE';
    }

    if ($dados !== '') {
        return (string) $dados;
    }

    return 'NULL';
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
     * Retorna uma lista de contatos
     * @return array/boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
       $stmt = $conexao->prepare(
        "SELECT * FROM contatos WHERE excluido = 0;"
        );
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Contato::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    /**
     * Retornar o número de registros
     * @return int/boolean
     */
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM contatos;");
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
        $stmt    = $conexao->prepare("SELECT * FROM contatos WHERE id='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Contato');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
   public static function findByEmail($email)
{
    $conexao = Conexao::getInstance();

    $stmt = $conexao->prepare(
        "SELECT * FROM contatos 
         WHERE email = :email
         AND excluido = 0"
    );

    $stmt->bindValue(':email', $email);
    $stmt->execute();

    return $stmt->fetchObject('Contato') ?: false;
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
        "UPDATE contatos 
         SET excluido = 1
         WHERE id = :id"
    );

    $stmt->bindValue(':id', $id);

    return $stmt->execute();
}
}