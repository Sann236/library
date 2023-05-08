<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'book_id', 'issue_status', 'return_day'
    ];



    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    protected $casts = [
        'issue_date' => 'datetime:Y-m-d',
        'return_date' => 'datetime:Y-m-d',
        'return_day' => 'datetime:Y-m-d',
    ];
}
