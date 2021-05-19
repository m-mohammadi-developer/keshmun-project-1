<?php 

namespace App\Interfaces;

/**
 * All the Database Classes(drivers) We create
 * Must Implement This Interface
 */
interface DatabaseInterface
{

    public function __construct(string $host, string $user, string $password, string $name);

    public function selectAll(string $sql, array $values = [], string $class);

    public function select(string $sql, array $values = [], string $class);

    public function do(string $sql, array $values = []);

    public function query(string $sql);

    
}