<?php

namespace Cms\models;

use System\Model;
use System\Query;

class Page extends Model
{
    protected $permittedColumns = array('title', 'content');
}
