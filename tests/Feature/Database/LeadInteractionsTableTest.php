<?php

namespace Tests\Feature\Database;

class LeadInteractionsTableTest extends BaseDatabase
{
    protected $table = 'lead_interactions';

    public static $fieldTypes = [
        'id' => ['type' => 'bigint', 'unsigned' => true],
        'lead_id' => ['type' => 'bigint', 'unsigned' => true],
        'status_id' => ['type' => 'bigint', 'unsigned' => true, 'nullable' => true],
        'message' => ['type' => 'text', 'nullable' => true],
        'notes' => ['type' => 'text', 'nullable' => true],
        'user_id' => ['type' => 'bigint', 'unsigned' => true, 'nullable' => true],
        'created_at' => ['type' => 'timestamp', 'nullable' => true],
        'updated_at' => ['type' => 'timestamp', 'nullable' => true],
    ];

    public static $primaryKey = ['id']; // Chave primária

    public static $autoIncrements = ['id']; // Campos auto_increment

    public static $foreignKeys = [
        'lead_interactions_lead_id_foreign',
        'lead_interactions_user_id_foreign',
        'lead_interactions_status_id_foreign',
    ]; // Definição das chaves estrangeiras

    public static $uniqueKeys = []; // Nenhuma chave única definida
}
