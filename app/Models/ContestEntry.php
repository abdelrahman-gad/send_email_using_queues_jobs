<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewEntryReceivedEvent;
class ContestEntry extends Model
{
    use HasFactory;
    protected $table ='contest_entries';
    protected $guarded = [];
    protected static function booted(){
        static::created(function($contestEntry){
            NewEntryReceivedEvent::dispatch($contestEntry);
        });
    }
}
