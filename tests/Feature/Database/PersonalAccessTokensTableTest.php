<?php

namespace Tests\Feature\Database;

class PersonalAccessTokensTableTest extends BaseDatabaseTest
{
    protected $table = 'personal_access_tokens';

    public static $fieldTypes = [
        'id' => ['type' => 'bigint', 'unsigned' => true],
        'tokenable_type' => ['type' => 'varchar', 'length' => 255],
        'tokenable_id' => ['type' => 'bigint', 'unsigned' => true],
        'name' => ['type' => 'varchar', 'length' => 255],
        'type' => ['type' => 'enum', 'values' => ['web', 'mobile']],
        'token' => ['type' => 'varchar', 'length' => 64],
        'abilities' => ['type' => 'text', 'nullable' => true],
        'last_used_at' => ['type' => 'timestamp', 'nullable' => true],
        'expires_at' => ['type' => 'timestamp', 'nullable' => true],
        'created_at' => ['type' => 'timestamp', 'nullable' => true],
        'updated_at' => ['type' => 'timestamp', 'nullable' => true],
        'deleted_at' => ['type' => 'timestamp', 'nullable' => true],
    ];

    public static $primaryKey = ['id']; // Chave primária

    public static $autoIncrements = ['id']; // Campos auto_increment

    public static $foreignKeys = []; // Nenhuma chave estrangeira definida

    public static $uniqueKeys = [
        'personal_access_tokens_token_unique',
    ]; // Chave única para `token`
}
