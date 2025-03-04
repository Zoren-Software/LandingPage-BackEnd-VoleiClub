<?php

namespace Tests\Feature\Database;

class PasswordResetTokensTableTest extends BaseDatabaseTest
{
    protected $table = 'password_reset_tokens';

    public static $fieldTypes = [
        'email' => ['type' => 'varchar', 'length' => 255],
        'token' => ['type' => 'varchar', 'length' => 255],
        'created_at' => ['type' => 'timestamp', 'nullable' => true],
    ];

    public static $primaryKey = ['email']; // Chave primária

    public static $autoIncrements = []; // Nenhum campo auto_increment

    public static $foreignKeys = []; // Nenhuma chave estrangeira definida

    public static $uniqueKeys = []; // Nenhuma chave única adicional além da PK
}
