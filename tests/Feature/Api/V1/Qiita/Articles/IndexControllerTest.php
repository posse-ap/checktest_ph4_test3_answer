<?php

namespace Tests\Feature\Api\V1\Qiita\Articles;

use App\Models\QiitaArticle;
use App\Services\Interfaces\GetQiitaArticlesInterface;
use App\Services\GetQiitaArticles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Mockery;


class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    # TODO 問3
    public function test_get_request()
    {
        # 実行前にrecordがないことを確認
        $this->assertEquals(QiitaArticle::all()->count(), 0);
        # requestを投げる
        $response = $this->get('/api/api/v1/qiita/articles');
        # 期待する分だけrecord数が増えていることを確認
        $this->assertEquals(QiitaArticle::all()->count(), 9);
        # responseのstatusがResponse::HTTP_CREATED(201)であることを確認
        $response->assertStatus(Response::HTTP_CREATED);
        # responseの内容を確認
        $response->assertExactJson([
            "message" => "create success",
            "status" => Response::HTTP_CREATED,
        ]);
    }

    public function test_return_value_when_request_success()
    {
        $mock = Mockery::mock(GetQiitaArticles::class);
        $mock->shouldReceive('execute')
            ->once()
            ->andReturn(
                [
                    0 => ["id" => 1, "title" => "qiita title 1", "url" => "qiita url 1"],
                    1 => ["id" => 2, "title" => "qiita title 2", "url" => "qiita url 2"],
                ]
            );
        $this->instance(GetQiitaArticlesInterface::class, $mock);

        $response = $this->get('/api/api/v1/qiita/articles');

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertExactJson([
            'message' => 'create success',
            'status' => Response::HTTP_CREATED,
        ]);
    }

    public function test_return_value_when_request_failed()
    {
        # TODO 問4 テスト実装部分
        # 上のtest_return_value_when_request_successを参考にMockeryを使いテストを書いてください

        # Arrange part
        # GetQiitaArticles::classをモック化する
        $mock = Mockery::mock(GetQiitaArticles::class);

        # このモックに対してがexecuteが呼ばれること、executeが呼ばれると\Exception("error", 500)を投げるように設定する
        $mock->shouldReceive('execute')
            ->andThrow(new \Exception("error", 500));

        # GetQiitaArticlesInterface::classが呼ばれたら、モックで依存解決をする
        $this->instance(GetQiitaArticlesInterface::class, $mock);


        # Act part
        # リクエストを投げる
        $response = $this->get('/api/api/v1/qiita/articles');


        # Assert part
        # response statusがResponse::HTTP_INTERNAL_SERVER_ERROR(500)であることを確認
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        #responseに期待するmessageとstatusがあることを確認する
        $response->assertExactJson([
            "message" => "error",
            "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
        ]);
    }
}
