<?php
namespace DreamFactory\Core\Contracts;

interface SchemaInterface extends CacheInterface, DbExtrasInterface
{
    /**
     * Return an array of supported schema resource types.
     *
     * @return array
     */
    public function getSupportedResourceTypes();

    /**
     * @param string $type Resource type
     *
     * @return boolean
     */
    public function supportsResourceType($type);

    /**
     * @param string $type Resource type
     * @param string $name
     * @param bool   $returnName
     *
     * @return mixed
     */
    public function doesResourceExist($type, $name, $returnName = false);

    /**
     * Return an array of names of a particular type of resource.
     *
     * @param string $type    Resource type
     * @param string $schema  Schema name if any specific requested
     * @param bool   $refresh Clear cache and retrieve anew?
     *
     * @return array
     */
    public function getResourceNames($type, $schema = '', $refresh = false);

    /**
     * Return the metadata about a particular schema resource.
     *
     * @param string $type    Resource type
     * @param string $name    Resource name
     * @param bool   $refresh Clear cache and retrieve anew?
     *
     * @return mixed
     */
    public function getResource($type, $name, $refresh = false);

    /**
     * @param string $type Resource type
     * @param string $name Resource name
     *
     * @return mixed
     */
    public function dropResource($type, $name);

    /**
     * @return string
     */
    public function getTimestampForSet();

    /**
     * @param mixed $value
     * @param       $field_info
     *
     * @return mixed
     */
    public function parseValueForSet($value, $field_info);

    /**
     * @param mixed  $value
     * @param string $type
     *
     * @return mixed
     */
    public function formatValue($value, $type);

    /**
     * @return string|null
     */
    public function getUserSchema();

    /**
     * @param string|null $schema
     */
    public function setUserSchema($schema);

    /**
     * @param $defaultSchemaOnly
     */
    public function setDefaultSchemaOnly($defaultSchemaOnly);

    /**
     * @return mixed
     */
    public function isDefaultSchemaOnly();

    /**
     * @param      $tables
     * @param bool $allow_merge
     * @param bool $allow_delete
     * @param bool $rollback
     *
     * @return mixed
     */
    public function updateSchema($tables, $allow_merge = false, $allow_delete = false, $rollback = false);

    /**
     * @param $table
     *
     * @return mixed
     */
    public function quoteTableName($table);

    /**
     * @param $column
     *
     * @return mixed
     */
    public function quoteColumnName($column);

    /**
     * Set the Caching interface.
     *
     * @param  CacheInterface $cache
     */
    public function setCache($cache);

    /**
     * @return mixed
     */
    public function flushCache();

    /**
     * Set the DB Extras interface.
     *
     * @param  DbExtrasInterface $storage
     */
    public function setExtraStore($storage);

    /**
     * @return mixed
     */
    public function refresh();

    /**
     * @param string $name
     * @param array  $in_params
     *
     * @throws \Exception
     * @return mixed
     */
    public function callFunction($name, array $in_params);

    /**
     * @param string $name
     * @param array  $in_params
     * @param array  $out_params
     *
     * @throws \Exception
     * @return mixed
     */
    public function callProcedure($name, array $in_params, array &$out_params);

    /**
     * @param mixed $field
     *
     * @return mixed
     */
    public function getPdoBinding($field);

    /**
     * @param mixed   $field
     * @param boolean $as_quoted_string
     *
     * @return string
     */
    public function parseFieldForSelect($field, $as_quoted_string = false);

    /**
     * @param mixed   $field
     * @param boolean $as_quoted_string
     *
     * @return string
     */
    public function parseFieldForFilter($field, $as_quoted_string = false);

    /**
     * @param string $type DbSimpleTypes value
     *
     * @return string Valid PHP type
     */
    public function determinePhpConversionType($type);
}