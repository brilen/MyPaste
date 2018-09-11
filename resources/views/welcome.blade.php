<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="post" action="{{ url('/') }}">
		{{ csrf_field() }}
		<textarea name="paste_code" class="paste_textarea" rows="10" id="paste_code" ></textarea>
		
		<div class="form_frame">
				<div class="form_left">
					Срок действия пасты:
				</div>
				<div class="form_right">
					<select class="" name="paste_expire_time">	
						<option value="10M" selected="selected">10 Minutes</option>
						<option value="1H">1 Hour</option>
						<option value="3H">3 Hour</option>
						<option value="1D">1 Day</option>
						<option value="1W">1 Week</option>
						<option value="Never">Never</option>
					</select>
				</div>
			</div>
			<div class="form_frame">
				<div class="form_left">
					Доступ к пасте:
				</div>
				<div class="form_right">
					<select class="" name="paste_private">
						<option value="0" selected="selected">Public</option>
						<option value="1">Unlisted</option>
					</select>
				</div>
			</div>
		<div class="form_frame">
				<div class="form_left">
					Название пасты:
				</div>
				<div class="form_right">
					<input type="text" name="paste_name" size="20" maxlength="60" value="" class="">
				</div>
			</div>
		<input name="submit" type="submit" value="Создать Пасту" id="submit" class="">
	</form>
            </div>
            <div class="container">
            <span>Последние пасты</span>
            <ul>
                @foreach ($pastes as $paste)
                <li>
                    <a href="{{$paste->hash}}">
                        {{$paste->name}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        </div>
    </body>
</html>
