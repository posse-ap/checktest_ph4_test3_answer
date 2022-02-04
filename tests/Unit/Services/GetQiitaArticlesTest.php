<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Services\GetQiitaArticles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Repositories\CreateQiitaArticles;

class GetQiitaArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    # TODO 問5
    public function test_call_repository_when_request_success()
    {
        # Arrange & Assert

        # CreateQiitaArticles::classのmockを作る
        $mock = Mockery::mock(CreateQiitaArticles::class);
        # モックがexecuteを1度だけ呼び出すことを確認する
        # NOTE: このコードをActの下に持ってくるとテストが正常に動かない
        $mock->shouldReceive('execute')
            ->once();

        # Act
        $service = new GetQiitaArticles($mock);
        $service->execute();
    }

    # TODO 問6
    public function test_not_call_repository_when_request_failedand_thorw_error()
    {
        # Arrange & Assert

        # CreateQiitaArticles::classのmockを作る
        $mock = Mockery::mock(CreateQiitaArticles::class);
        # モックがexecuteを呼び出さないことを確認する
        $mock->shouldNotReceive('execute');
        # \Illuminate\Http\Client\RequestException::classが投げられることを確認する
        # NOTE: このコードをActの下に持ってくるとテストが正常に動かない
        $this->expectException(\Illuminate\Http\Client\RequestException::class);

        # Act
        $service = new GetQiitaArticles($mock);
        # NOTE Qiita APIに存在しないpathを指定して\Illuminate\Http\Client\RequestException::classを起こす
        # Qiita API部分をモック化しても良いが、モック化しすぎもよくない、考慮漏れなどが発生しやすい。
        $service->execute("not_exists_path");
    }
}
