trait EnumerableColumn
{
    public function enumColumn(Blueprint $table, string $column, array $parameters = [])
    {
        (!Schema::hasColumn($table->getTable(), $column)) ?

            $table->enum($column, $parameters) :

            $this->modifyEnum($table->getTable(), $column, $parameters);
    }

    protected function modifyEnum($tableName, $columnName, $newValues)
    {
        $enum = implode("','", $newValues);
        DB::statement("ALTER TABLE `$tableName` MODIFY COLUMN `$columnName` ENUM('$enum')");
    }
}
