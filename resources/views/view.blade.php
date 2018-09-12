@extends('layouts.layout')

@section('content')
    <h4 class="mb-3">Твоя паста!</h4>
    <form method="post" action="{{ url('/') }}">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="paste_url">Ссылка на твою пасту:</label>
            <input type="text" id="paste_url" class="form-control" value="{{ url('/').'/'.$paste->hash }}" readonly>
        </div>
        <div class="mb-3">
            <label for="paste_name">Название пасты:</label>
            <input type="text" id="paste_name" class="form-control" value="{{$paste->name}}" readonly>
        </div>
        <div class="mb-3">
            <textarea name="paste_code" class="form-control" id="paste_code" readonly>{{$paste->code}}</textarea>
        </div> 
    </form>
    
@endsection
                    
               
