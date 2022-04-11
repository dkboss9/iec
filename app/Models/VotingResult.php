<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingResult extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'user_id');
    } 
    public function program_info(){
        return $this->belongsTo(Voting::class,'voting_id');
    }
    public function participant_info(){
        return $this->belongsTo(VotingOption::class,'voption_id');
    }
}
