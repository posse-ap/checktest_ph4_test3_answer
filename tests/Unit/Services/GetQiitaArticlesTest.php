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

    # TODO 問4
    public function test_call_repository_when_request_success()
    {
        # ここを実装してください
    }

    # TODO 問5
    public function test_not_call_repository_when_request_failedand_thorw_error()
    {
        # ここを実装してください
    }
}
