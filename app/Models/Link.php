<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'link',
        'short_link',
        'status',
        'customize',
        'description',
        'expire_date',
    ];

    protected static function boot()
    {
        parent::boot();

        // Using the "creating" event to generate the short_link before saving the model
        static::creating(function ($model) {
            $model->generateShortLink();
            $model->setUserId();
        });
    }
    public function generateShortLink()
    {
        $length = 6;
        $attempts = 0;
        do {
            $shortLink = Str::random($length);
            $existingModel = self::where('short_link', $shortLink)->exists();

            $attempts++;
            if ($attempts >= 20) {
                die('Unable to generate a unique short_link after 20 attempts.');
            }
        } while ($existingModel);

        $this->attributes['short_link'] = $shortLink;
    }
    public function setUserId()
    {
        $this->attributes['user_id'] =  auth()->user()->id;
    }
    public function getShortLinkAttribute($value): string
    {
       return env("APP_URL") . "/l/" . $value;
    }

}
