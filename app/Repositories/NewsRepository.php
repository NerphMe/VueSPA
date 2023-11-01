<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NewsRepository extends BaseRepository
{
    protected Model $model;
    public function __construct(News $news)
    {
        parent::__construct($news);
        $this->model = $news;
    }

    public function updateStatus(int $id, string $status): void
    {
        $news = News::where('id', $id)->first();
        $news->update([
            'status' => $status
        ]);
    }
    public function getNewsItemsOverview(array $params): Builder
    {
        $query = $this->model::query();
        $query = $this->applyCommonQueries($query);

        return $this->applyPagination($query, $params['pageIndex']);
    }

    protected function applyCommonQueries(Builder $query): Builder
    {
        return $query->where('status', News::ACTIVE_STATUS);
    }
}
