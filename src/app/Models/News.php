<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false; // set time to false

        protected $fillable = [
            'news_title',
            'news_slug',
            'news_views',
            'news_desc',
            'news_content',
            'news_status',
            'news_image',
            'cate_news_id'
        ];

        protected $primaryKey = 'news_id';
        protected $table = 'tbl_news';

        public function cate_news(){
            return $this->belongsTo('App\Models\CateNews','cate_news_id');
        }

}
