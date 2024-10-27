<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

//Developed by G.R Gayan Kavinda Gamlath 
//gayankavinda98v.lk@gmail.com
//2024 SLIIT Internship 
//Ministry of Home Affairs (MOHA)

class Message extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'body',
        'district',
        'workplace',
        'email',
        'conversation_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['sender_id', 'receiver_id', 'subject', 'body', 'district', 'workplace', 'email', 'conversation_id'])
            ->useLogName('message')
            ->logOnlyDirty();
    }

    /**
     * Get the user who sent this message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the user who received this message.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the conversation associated with the message.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
