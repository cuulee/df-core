<?php
/**
 * This file is part of the DreamFactory Rave(tm)
 *
 * DreamFactory Rave(tm) <http://github.com/dreamfactorysoftware/rave>
 * Copyright 2012-2014 DreamFactory Software, Inc. <support@dreamfactory.com>
 *
 * Licensed under the Apache License, Version 2.0 (the 'License');
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an 'AS IS' BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace DreamFactory\Rave\Models;

use DreamFactory\Rave\Contracts\ServiceConfigHandlerInterface;

/**
 * ServiceType
 *
 * @property string  $name
 * @property string  $class_name
 * @property string  $config_handler
 * @property string  $label
 * @property string  $description
 * @property string  $group
 * @property boolean $singleton
 * @method static \Illuminate\Database\Query\Builder|ServiceType whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|ServiceType whereLabel( $value )
 * @method static \Illuminate\Database\Query\Builder|ServiceType whereSingleton( $value )
 * @method static \Illuminate\Database\Query\Builder|ServiceType whereGroup( $value )
 */
class ServiceType extends BaseModel
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_date';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'last_modified_date';

    protected $table = 'service_type';

    protected $primaryKey = 'name';

    protected $guarded = [ '*' ]; //

    protected $hidden = [ 'class_name', 'config_handler' ];

    protected $appends = [ 'config_schema' ];

    protected $casts = [ 'singleton' => 'boolean' ];

    public $incrementing = false;

    public function getConfigSchemaAttribute()
    {
        if ( is_subclass_of( $this->config_handler, 'DreamFactory\Rave\Contracts\ServiceConfigHandlerInterface' ) )
        {
            /** @var ServiceConfigHandlerInterface $handler */
            $handler = $this->config_handler;

            return $handler::getConfigSchema();
        }

        return null;
    }
}