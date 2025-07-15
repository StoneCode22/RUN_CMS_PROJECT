<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class complaint_management_system extends Model
{
    public function getAuthIdentifierName()
{
    return 'matric_no';
}

}
