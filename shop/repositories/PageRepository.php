<?php

namespace shop\repositories;

use shop\dispatchers\EventDispatcher;
use shop\entities\Page;
use yii\caching\TagDependency;

class PageRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    public function get($id): Page
    {
        if (!$page = Page::findOne($id)) {
            throw new NotFoundException('Page is not found.');
        }
        return $page;
    }

    public function save(Page $page): void
    {
        if (!$page->save()) {
            throw new \RuntimeException('Saving error.');
        }
        TagDependency::invalidate(\Yii::$app->cache,['page']);
        //$this->dispatcher->dispatchAll($page->releaseEvents());
    }

    public function remove(Page $page): void
    {
        if (!$page->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}