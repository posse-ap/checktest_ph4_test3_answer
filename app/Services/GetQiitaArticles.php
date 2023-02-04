<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\Interfaces\CreateQiitaArticlesInterface;
use App\Services\Interfaces\GetQiitaArticlesInterface;
use Illuminate\Support\Facades\Log;
use \Symfony\Component\HttpFoundation\Response;

class GetQiitaArticles implements GetQiitaArticlesInterface
{
    private CreateQiitaArticlesInterface $create_qiita_article;
    private const QIITA_BASE_URL = 'https://qiita.com/api/v2/';

    public function __construct(CreateQiitaArticlesInterface $create_qiita_article)
    {
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
        $response = '';
        $status = $response->status();

        if ($status === Response::HTTP_OK) {
            $this->create_qiita_article->execute(collect($response->json()));
        } else {
            $response->throw()->json();
        }
    }

}

