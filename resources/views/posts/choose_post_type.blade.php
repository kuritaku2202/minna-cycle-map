<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>投稿タイプの選択</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            投稿作成
        </x-slot>
        <body>
            <h1>投稿の種類を選んでください</h1>
            <h2><a href="/create_incident_report">被害報告</a></h2>
            <h2><a href="/create_suspicious_report">不審者・不審物の報告</a></h2>
            <h2><a href="/create_safety_report">安全な駐輪場情報の共有</a></h2>
        </body>
    </x-app-layout>
</html>