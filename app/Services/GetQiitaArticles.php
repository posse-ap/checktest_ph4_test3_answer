<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\Interfaces\CreateQiitaArticlesInterface;
use App\Services\Interfaces\GetQiitaArticlesInterface;
use \Symfony\Component\HttpFoundation\Response;

class GetQiitaArticles implements GetQiitaArticlesInterface
{
    private CreateQiitaArticlesInterface $create_qiita_article;
    private const QIITA_BASE_URL = 'https://qiita.com/api/v2/';

    public function __construct(CreateQiitaArticlesInterface $create_qiita_article)
    {
        # $this->create_qiita_articleにモックを代入することになる
        $this->create_qiita_article = $create_qiita_article;
    }

    /**
     *
     * Qiita APIで特定ユーザーの記事一覧を取得する
     * 取得に成功すれば、それを引数にしてリポジトリを呼び出す
     * 取得に失敗すれば、例外を投げる(controller層でcatchする)
     *
     * @param string $qiita_url_path Qiita APIのパス
     * @return void
     * @link https://qiita.com/api/v2/docs#get-apiv2authenticated_use/items
     * @throws \Illuminate\Http\Client\RequestException $qiita_url_pathに存在しないパスを指定すると404エラーが発生する
     */
    public function execute(string $qiita_url_path = 'authenticated_user/items'): void
    {
        # TODO 問2: 以下のリンク先にあるapiを呼び出してQiita記事を取得してください
        # base urlはL14行目に定義しているので、文字列連結して使ってください
        # ex: self::QIITA_BASE_URL . $qiita_url_path
        # tokenをセットする必要があるので、調べて設定してください
        # tokenは別途お渡しします
        # Http ClientとしてはGuzzleを使ってください
        # 参考: https://readouble.com/laravel/8.x/ja/http-client.html
        $response = Http::withToken(env('QIITA_TOKEN'))
            ->get(
                self::QIITA_BASE_URL . $qiita_url_path
            );
        # 以下の$statusをddで200になっていれば問2はクリアです
        $status = $response->status();

        if ($status === Response::HTTP_OK) {
            # TODO 問5 $status === Response::HTTP_OKを満たす時、mockを使い、
            # executeが呼ばれることをUnitテストで担保してください
            $this->create_qiita_article->execute(collect($response->json()));
        } else {
            # TODO 問6 $status === Response::HTTP_OKを満たさない時、mockを使い、
            # create_qiita_articleのexecuteが呼ばれないことをUnitテストで担保してください
            # また例外が投げられることをUnitテストで担保してください
            $response->throw()->json();
        }
    }

}
