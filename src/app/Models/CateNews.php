<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateNews extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'cate_news_name', 'cate_news_status', 'cate_news_slug', 'cate_news_desc'
    ];
    protected $primaryKey = 'cate_news_id';
 	protected $table = 'tbl_category_news';

    public function news(){
        $this->hasMany('App\Models\News');
    }
}
