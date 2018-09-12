@extends('layouts.layoutHome')

@section('content')
<div class="container">
        <div class="col-md-12 col-md-offset-1">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Название пасты</th>
                    <th scope="col">Текст пасты</th>
                    <th scope="col">Ссылка</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($userPastes as $paste)
                    <tr>
                      <td>{{$paste->name}}</td>
                      <td>{{$paste->code}}</td>
                      <td><a href="{{$paste->hash}}">{{ url('/').'/'.$paste->hash }}</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            {{$userPastes->links()}}
        </div>
</div>
@endsection
