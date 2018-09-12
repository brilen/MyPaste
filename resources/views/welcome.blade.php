@extends('layouts.layout')

@section('content')
    <h4 class="mb-3">Оставь свою пасту!</h4>
    <form method="post" action="{{ url('/') }}">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="paste_name">Название пасты:</label>
            <input type="text" name="paste_name" id="paste_name" class="form-control" size="20" maxlength="60" value="" class="">
        </div>
        <div class="mb-3">
            <textarea name="paste_code" class="form-control" rows="10" id="paste_code" ></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="paste_expire_time">Срок действия пасты:</label>	
                <select class="custom-select d-block w-100" name="paste_expire_time" id="paste_expire_time" required>	
                    <option value="10M" selected="selected">10 минут</option>
                    <option value="1H">1 час</option>
                    <option value="3H">3 часа</option>
                    <option value="D">1 день</option>
                    <option value="W">1 неделя</option>
                    <option value="M">1 месяц</option>
                    <option value="Never">Без ограничений</option>
                </select>	
            </div>
            <div class="col-md-6 mb-3">
                <label for="paste_private">Доступ к пасте:</label>
                <select class="custom-select d-block w-100" name="paste_private" id="paste_private">
                    <option value="0" selected="selected">Public</option>
                    <option value="1">Unlisted</option>
                </select>
            </div>
        </div>   
        <input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Создать Пасту" id="submit" class="">
    </form>
@endsection
