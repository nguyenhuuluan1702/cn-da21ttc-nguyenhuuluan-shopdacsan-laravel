<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_name','category_id','brand_id','product_desc','product_content','product_price','product_image','product_status','product_views','product_von'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';
}
