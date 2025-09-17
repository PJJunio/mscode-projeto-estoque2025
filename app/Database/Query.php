<?php

namespace App\Database;

class Query
{
    private \PDO $pdo;

    public function __construct()
    {
        $database = new Database(
            host: '127.0.0.1',
            database: 'mscode_estoque2025',
            username: 'root',
            password: 'root',
            port: 3306,
        );

        $this->pdo = $database->connection();
    }

    public function select(string $tabela, ?string $condicao = null, array $parametros = [], string $colunas = '*'): false|array
    {
        try {
            $sql = "SELECT {$colunas} FROM {$tabela}";

            if($condicao !== null) {
                $sql .= " WHERE {$condicao}";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erro na consulta: {$e->getMessage()}";

            return false;
        }
    }

    public function insert(string $tabela, array $dados): false|int
    {
        try {
            $colunas = implode(', ', array_keys($dados));
            $valores = ':' . implode(', :', array_keys($dados));

            $sql = "INSERT INTO {$tabela} ({$colunas}) VALUES ({$valores})";

            echo $sql . PHP_EOL;

            $stmt = $this->pdo->prepare($sql);

            foreach ($dados as $coluna => $valor) {
                $stmt->bindValue(":{$coluna}", $valor);
            }

            $stmt->execute();

            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            echo "Erro na inserção: {$e->getMessage()}";

            return false;
        }
    }

    public function update(string $tabela, array $dados, string $condicao, array $parametros = []): bool
    {
        try {
            $sets = [];

            foreach ($dados as $coluna => $valor) {
                $sets[] = "{$coluna} = :{$coluna}";
            }

            $sql = "UPDATE {$tabela} SET " . implode(', ', $sets) . " WHERE {$condicao}";

            $stmt = $this->pdo->prepare($sql);

            foreach ($dados as $coluna => $valor) {
                $stmt->bindValue(":{$coluna}", $valor);
            }

            $parametros_completos = array_merge($dados, $parametros);

            $stmt->execute($parametros_completos);

            return true;
        } catch (\PDOException $e) {
            echo "Erro na atualização: {$e->getMessage()}";

            return false;
        }
    }

    public function insertOne(string $tabela, string $coluna, string $condicao, array $parametros = []): bool
    {
        try {
            $sql = "UPDATE {$tabela} SET {$coluna} = {$coluna} + 1";

            if($condicao !== null) {
                $sql .= " WHERE {$condicao}";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            return true;
        } catch (\PDOException $e) {
            echo "Erro na atualização: {$e->getMessage()}";

            return false;
        }
    }

    public function decrementOne(string $tabela, string $coluna, string $condicao, array $parametros = []): bool
    {
        try {
            $sql = "UPDATE {$tabela} SET {$coluna} = {$coluna} - 1";

            if($condicao !== null) {
                $sql .= " WHERE {$condicao}";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            return true;
        } catch (\PDOException $e) {
            echo "Erro na atualização: {$e->getMessage()}";

            return false;
        }
    }

    public function delete(string $tabela, string $condicao, array $parametros = []): bool
    {
        try {
            $sql = "DELETE FROM {$tabela} WHERE {$condicao}";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            return true;
        } catch (\PDOException $e) {
            echo "Erro na exclusão: {$e->getMessage()}";

            return false;
        }
    }

    public function getPassword($email, $password)
    {
        try {
            $sql = 'SELECT senha FROM usuario WHERE email = :email';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $userPassword = $stmt->fetchColumn();

            if ($userPassword === $password) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo "Erro na busca: {$e->getMessage()}";

            return false;
        }
    }

    public function count(string $tabela, ?string $condicao = null, array $parametros = [], string $colunas = '*'): false|array
    {
        try {
            $sql = "SELECT COUNT({$colunas}) FROM {$tabela}";

            if($condicao !== null) {
                $sql .= " WHERE {$condicao}";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Erro na consulta: {$e->getMessage()}";

            return false;
        }
    }

}
