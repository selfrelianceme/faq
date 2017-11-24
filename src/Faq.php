<?php
namespace Selfreliance\Faq;
use Selfreliance\Faq\Models\Faq as FaqModel;
use Selfreliance\Faq\Models\Faqs_Data;

class Faq{
	public function get($lang=null){
		$Faq = FaqModel::orderBy('sort', 'asc')->get();
		if($Faq){
			foreach($Faq as $row){
				$res = Faqs_Data::where('faq_id', $row->id)->where('lang', $lang)->select('title', 'text')->first();
				if($res){
					$row->title = $res->title;
					$row->text = $res->text;
				}else{
					$row->title = "";
					$row->text = "";
				}
			}
		}

		return $Faq;
	}
}