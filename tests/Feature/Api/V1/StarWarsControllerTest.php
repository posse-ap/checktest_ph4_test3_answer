<?php

namespace Tests\Feature\Api\V1\Qiita\Articles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;


class StarWarsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
    }

    public function test_return_value_when_request_success()
    {
        # /api/api/v1/baconipsumにgetでrequestを投げている
        $response = $this->get('/api/api/v1/baconipsum');

        # requestに対するresponseのstatus codeがResponse::HTTP_OK(200)であることをテスト
        $response->assertStatus(Response::HTTP_OK);
        # responseにjson形式でtitleにA New Hope、release_dateに1977-05-25が含まれていることをテスト
        $response->assertExactJson([
            'title' => 'A New Hope',
            'release_date' => '1977-05-25',
        ]);
    }
}
