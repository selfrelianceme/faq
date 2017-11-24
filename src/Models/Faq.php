<?php

namespace Selfreliance\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Faq extends Model
{
	use SoftDeletes;
    //

    public function datas(){
        return $this->hasMany('Selfreliance\Faq\Models\Faqs_Data', 'faq_id');
    }
}
