<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <title>投稿作成（不審者・不審物情報）</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            投稿作成（不審者・不審物情報）
        </x-slot>
        <body>
            <div class="container">
                <!-- Content here -->
                <form action="/create_suspicious_report" method="post">
                    @csrf
                    <div class="user">
                        <input type="hidden" name="suspiciousReport[user_id]" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="spot">
                        <input type="hidden" name="suspiciousReport[spot_id]" value="{{ $spot->id }}">
                    </div>


                    <!-- 選択したスポット名 -->
                    <h1>{{ $spot->name }}</h1>

                    <div class="date">
                        <h2>目撃した日付</h2>
                        <p class="date_error" style="color:red">{{ $errors->first('suspiciousReport.date') }}</p>
                        <input type="date" name="suspiciousReport[date]" value="{{ old('suspiciousReport.date')}}" />
                    </div>
                    <div class="time_slot">
                        <h2>目撃した時間帯</h2>
                        <p class="time_slot_error" style="color:red">{{ $errors->first('suspiciousReport.time_period_id') }}</p>
                        @foreach ($timePeriods as $timePeriod)
                            <input type="radio" name="suspiciousReport[time_period_id]" value="{{ $timePeriod->id }}">
                                {{ $timePeriod->time_slot}}
                            </input><br>
                        @endforeach
                    </div>
                    <div class="description">
                        <h2>不審者・不審物の詳細情報</h2>
                        <p class="description_error" style="color:red">{{ $errors->first('suspiciousReport.description') }}</p>
                        <textarea name="suspiciousReport[description]"  placeholder="不審者・不審物の詳細情報を入力してください">{{ old('suspiciousReport.description')}}</textarea>
                    </div>
                    <input type="submit" value="投稿する"/>
                </form>
                <div class="backButton">
                    <a href="/choose_post_type">戻る</a>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>