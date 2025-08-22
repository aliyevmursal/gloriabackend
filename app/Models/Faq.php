<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['question', 'answer'];

    protected $hidden = ['question_az', 'question_en', 'answer_az', 'answer_en', 'is_active', 'created_at', 'updated_at', 'position'];

    public function getQuestionAttribute()
    {
        return [
            'az' => $this->question_az,
            'en' => $this->question_en,
        ];
    }

    public function getAnswerAttribute()
    {
        return [
            'az' => $this->answer_az,
            'en' => $this->answer_en,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrderByPosition($query)
    {
        return $query->orderBy('position', 'asc');
    }
}