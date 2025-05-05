<?php

namespace Tests\Feature\Database;

class LeadsTableTest extends BaseDatabase
{
    protected $table = 'leads';

    public static $fieldTypes = [
        'id' => ['type' => 'bigint', 'unsigned' => true],
        'tenant_id' => ['type' => 'varchar', 'length' => 255, 'nullable' => true],
        'status_id' => ['type' => 'bigint', 'unsigned' => true, 'nullable' => true],
        'name' => ['type' => 'varchar', 'length' => 255],
        'email' => ['type' => 'varchar', 'length' => 255],
        'email_verified_at' => ['type' => 'timestamp', 'nullable' => true],
        'unsubscribed_at' => ['type' => 'timestamp', 'nullable' => true],
        'experience_level' => ['type' => 'enum', 'values' => ['beginner', 'amateur', 'student', 'college']],
        'message' => ['type' => 'text'],
        'created_at' => ['type' => 'timestamp', 'nullable' => true],
        'updated_at' => ['type' => 'timestamp', 'nullable' => true],
        'deleted_at' => ['type' => 'timestamp', 'nullable' => true],
    ];

    public static $primaryKey = ['id']; // Chave primária

    public static $autoIncrements = ['id']; // Campos auto_increment

    public static $foreignKeys = [
        'leads_status_id_foreign',
    ];

    public static $uniqueKeys = [
        'leads_email_unique',
    ]; // Chaves únicas
}
