# チェックテスト(v1.0.0)

## 前提

本アプリケーションは[Laravel Sail](https://readouble.com/laravel/8.x/ja/sail.html) を利用しています

## 準備
```
// ソースコードをクローンする
git clone git@github.com:posse-ap/checktest_ph4_test3.git

// プロジェクトルートへ移動
cd checktest_ph4_test3

// .env, .env.testingファイルを作成し、設定をコピペする
cp .env.example .env
cp .env.example .env.testing
```

コンテナを起動するのですが、本アプリケーションはLaravel Sail を利用しています。
事前にPCに composer をインストールしておく必要があります。
```
composer require laravel/sail --dev
vendor/bin/sail up -d
```

http://localhost/　にアクセスするとLaravelの画面が表示されます。

コンテナを停止したい場合は以下のコマンドを実施
```
vendor/bin/sail stop
```

## 問題

### 問1 外部APIを使ってみる

1. App\Http\Controllers\Api\V1\StarWarsControllerの__invokeを実装する
2. StarWarsControllerに関するテストを流してみる

テストが通れば合っています

テストコマンド（コンテナが起動している必要があります）
```
vendor/bin/sail test tests/Feature/Api/V1/StarWarsControllerTest.php
```

### 問2 外部APIを使ってみる(2)

App\Services\GetQiitaArticles.phpを確認し、TODOコメント部分を実装してください。

### 問3 api/api/v1/qiita/articlesのテストを書こう

tests/Feature/Api/V1/Qiita/Articles/IndexControllerTest.phpをご確認ください
test_get_request内に以下を確認するテストを書いてください

1. qiita_articlesテーブルにレコードが登録されること
2. レスポンスのステータスが期待通りなこと
3. レスポンスのmessageとstatusが期待通りなこと

### 問4 FeatureテストをMockeryを使って書いてみよう

App\Http\Controllers\Api\V1\Qiita\Articles\IndexControllerにある問3に関するTODOコメントを確認してください

### 問5 GetQiitaArticlesのテストを書こう

Tests\Unit\Repositories\GetQiitaArticlesTest.phpを確認し、
test_call_repository_when_request_successに Mockeryを使いCreateQiitaArticlesのexecuteが呼ばれることを担保してください

### 問6 GetQiitaArticlesのテストを書こう(例外編)

Tests\Unit\Services\GetQiitaArticlesTest.phpを確認してください
Mockeryを使いCreateQiitaArticlesのexecuteが呼ばれると例外が投げられるようにしてください
 
### 問7 CreateQiitaArticlesのテストを書こう

Tests\Unit\Repositories\CreateQiitaArticlesTest.phpを確認してください

1. qiita_articlesテーブルにレコードが登録されるようにexecuteに適当なデータを入れて、レコードが登録されることを担保してください
2. executeに空の配列(Collection)を入れて、レコードが登録されないことを担保してください


author: ハシモト流エンジニアリング家元
