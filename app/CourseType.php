<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = "tipos_cursos";
    protected $primaryKey = "codigo";
}
