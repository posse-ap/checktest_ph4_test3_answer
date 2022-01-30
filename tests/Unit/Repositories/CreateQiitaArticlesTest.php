<?php

namespace Tests\Unit\Repositories;

use App\Models\QiitaArticle;
use Tests\TestCase;
use App\Repositories\CreateQiitaArticles;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateQiitaArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    # TODO 問6
    # $articles_dataが空のCollectionの時、1件も登録されていないことをUnitテストで担保してください
    public function test_empty_collection_given()
    {
        $this->assertEquals(QiitaArticle::all()->count(), 0);
        $create_qiita_articles = new CreateQiitaArticles();
        $create_qiita_articles->execute(collect([]));
        $this->assertEquals(QiitaArticle::all()->count(), 0);
    }

    # TODO 問6
    # upsertした結果、3件だけDBに登録されていることをUnitテストで担保してください
    public function test_not_empty_collection_given()
    {
        $parameters = [
            [
                "title" => "title1",
                "url" => "url1",
                "id" => "article_id1",
            ],
            [
                "title" => "title2",
                "url" => "url2",
                "id" => "article_id2",
            ],
        ];
        $this->assertEquals(QiitaArticle::all()->count(), 0);
        $create_qiita_articles = new CreateQiitaArticles();
        $create_qiita_articles->execute(collect($parameters));
        $this->assertEquals(QiitaArticle::all()->count(), count($parameters));
    }
}
