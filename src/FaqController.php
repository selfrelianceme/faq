<?php
namespace Selfreliance\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Selfreliance\Faq\Models\Faq;
use Selfreliance\Faq\Models\Faqs_Data;
use Validator;
use DB;
class FaqController extends Controller
{
    /**
     * Index
     * @return view home with feedback messages
    */    
    public function index()
    {
    	$faq = Faq::orderBy('sort', 'asc')->select('id', 'sort', 'created_at')->get();
    	foreach($faq as $row){
    		$row->data = Faqs_Data::where('faq_id', $row->id)->orderBy('id', 'asc')->select('title')->first();
    	}
    	return view('faq::index', compact('faq'));
    }

    public function create(){
    	$Language = \LaravelGettext::getSupportedLocales();
    	$Faq = "";
    	$sort = (Faq::max('sort'))+1;
    	return view('faq::create')->with(compact('Language', 'Faq', 'sort'));
    }

    public function edit($id){
		$Faq = Faq::find($id);
		$Data = $Faq->datas()->get();
		$DataLang = [];
		$Data->each(function($row) use (&$DataLang){
			$DataLang[$row->lang] = $row;
		});
		$Language = \LaravelGettext::getSupportedLocales();
    	return view('faq::create')->with(compact('Language', 'Faq', 'DataLang'));
    }

    public function store($faq_id, Request $request){
    	$Language = \LaravelGettext::getSupportedLocales();
    	$rules = [];
    	foreach($Language as $lang){
    		$rules['title.'.$lang] = 'required';
    		$rules['text.'.$lang] = 'required';
    	}
    	$validator = Validator::make($request->all(), $rules);
    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}
    	DB::beginTransaction();
			if($faq_id == 0){
				$modelFaq = new Faq;
				// if($request->input('sort') != 0){
			    	$modelFaq->sort = $request->input('sort');
				// }
			    $modelFaq->save();
			}else{
				$modelFaq = Faq::find($faq_id);
				if($modelFaq->sort != $request->input('sort')){
					$modelFaq->sort = $request->input('sort');
					$modelFaq->save();
				}
            	$modelFaq->datas()->delete();
			}

			foreach($request->input('title') as $key=>$value){
		        if($value != ''){
		            $modelData = new Faqs_Data;
		            $modelData->lang = $key;
		            $modelData->title = $value;
		            $modelData->text = $request->input('text')[$key];
		            $modelFaq->datas()->save($modelData);
		        }
		    }
        DB::commit();
        $message = ($faq_id==0)?"Успешно добавлено":'Успешно обновлено';
        return redirect()->back()->with(['success' => $message]);
    }

    public function destroy($id){
    	DB::beginTransaction();
	    	$ModelFaq = Faq::findOrFail($id);
	        $ModelFaq->datas()->delete();
	        $ModelFaq->delete();
        DB::commit();
        return redirect()->back()->with(['success' => "Пункт faq удален"]);
    }
}