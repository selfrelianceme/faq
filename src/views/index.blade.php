@extends('adminamazing::teamplate')

@section('pageTitle', 'Faq')
@section('content')
    <script>
        var route = '{{ route('AdminFaqDestroy') }}';
        var message = 'Вы точно хотите удалить данный пункт?';
    </script>
    @push('display')
        <a href="{{route('AdminFaqCreate')}}" class="btn hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Создать новый</a>
    @endpush
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <div class="clearfix">
                        <h4 class="card-title pull-left">@yield('pageTitle')</h4>
                    </div>
                    @if(count($faq) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Заголовок</th>
                                    <th>Дата</th>
                                    <th class="text-nowrap">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faq as $onefaq)
                                    <tr>
                                        <td>{{$onefaq->id}}</td>
                                        <td>{{$onefaq->data->title}}</td>
                                        <td>{{$onefaq->created_at}}</td>
                                        <td class="text-nowrap">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="{{ route('AdminFaqEdit', $onefaq->id) }}" data-toggle="tooltip" data-original-title="Редактировать"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                            <a href="#deleteModal" class="delete_toggle" data-id="{{ $onefaq->id }}" data-toggle="modal"><i class="fa fa-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert text-center">
                        <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> На данный момент отсутствуют пункты faq
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection