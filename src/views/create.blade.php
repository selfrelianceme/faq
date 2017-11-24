@extends('adminamazing::teamplate')

@section('pageTitle', 'Добавление/Редактирование')
@section('content')
    @push('scripts')
    	<script type="text/javascript">
    		$(document).ready(function() {
	    		@foreach($Language as $lang)
	    			// $('.text{{$lang}}').wysihtml5();
	    		@endforeach
    		});
    	</script>
    @endpush
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    <div class="card">
        <form action="{{route('AdminFaqUpdate', ($Faq != '')?$Faq->id:0)}}" method="POST" class="form-horizontal" id="main" enctype="multipart/form-data">
            <ul class="nav nav-tabs customtab" role="tablist">
                @foreach($Language as $lang)
                    <li class="nav-item"> <a class="nav-link {{ ($loop->first)?'active':NULL}}" data-toggle="tab" href="#tab{{$lang}}" role="tab">{{Config::get('laravel-gettext.supported-locales-pare')[$lang]}}</a> </li>
                @endforeach                
            </ul>
            <div class="tab-content">                    
                @foreach($Language as $lang)
                    <div class="tab-pane  p-20 {{ ($loop->first)?'active':NULL}}" id="tab{{$lang}}">
                        <div class="box-body pad">
                            <div class="form-group{{ $errors->has('title.'.$lang) ? ' error' : '' }}">
                                <label for="title{{$lang}}" class="col-md-12">Заголовок ({{Config::get('laravel-gettext.supported-locales-pare')[$lang]}})</label>
                                <div class="col-md-12">
                                    <input type="text" 
                                    value="{{old('title.'.$lang, (isset($DataLang[$lang]))?$DataLang[$lang]->title:NULL)}}" 
                                    placeholder="" class="form-control" name="title[{{$lang}}]" id="title{{$lang}}">
                                    @if ($errors->has('title.'.$lang))
                                        <div class="help-block">
                                            <ul role="alert"><li>{{ $errors->first('title.'.$lang) }}</li></ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('text.'.$lang) ? ' error' : '' }}">
                                <label for="text{{$lang}}" class="col-md-12">Текст ({{Config::get('laravel-gettext.supported-locales-pare')[$lang]}})</label>

                                <div class="col-md-12">
                                    <textarea class="form-control text{{$lang}}" name="text[{{$lang}}]" id="text{{$lang}}" rows="15">{!!old('title.'.$lang, (isset($DataLang[$lang]))?$DataLang[$lang]->text:NULL)!!}</textarea>
                                    @if ($errors->has('text.'.$lang))
                                        <div class="help-block">
                                            <ul role="alert"><li>{{ $errors->first('text.'.$lang) }}</li></ul>
                                        </div>
                                    @endif
                                </div>
                            </div>                                        
                        </div>                                    
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="sort" class="col-md-12">Сортировка</label>
                    <div class="col-md-12">
                        <input type="text" name="sort" id="sort" value="{{old('sort', (isset($Faq->sort)?$Faq->sort:$sort))}}" class="form-control">
                    </div>
                </div>
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success">{{($Faq)?"Обновить запись":"Добавить запись"}}</button>
                </div>
            </div>
        </form>          
    </div>
@endsection