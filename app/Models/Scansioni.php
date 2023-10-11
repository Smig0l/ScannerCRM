<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scansioni extends Model
{
    use HasFactory;

    protected $fillable = [
        'codice_articolo',
        'quantita_rilevata',
    ];
}
