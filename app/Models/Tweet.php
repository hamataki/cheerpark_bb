<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    
    // ↓1行追加
  protected $fillable = ['tweet'];

  // 以下userメソッド追加
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  
  // 🔽 追加 🔽 
  public function liked()
  {
      return $this->belongsToMany(User::class)->withTimestamps();
  }
  
  public function mypage()
  {
    return $this->belongsTo(Mypage::class);
  }
}
