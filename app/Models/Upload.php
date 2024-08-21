<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image_url',
    ];
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count); //Eagerローディングという機能で、リレーションによって増えてしまうデータベースアクセスの回数を減らすための機能です。
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
