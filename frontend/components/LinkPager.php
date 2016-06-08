<?php
namespace frontend\components;
use yii\bootstrap\Html;
use Yii;

class LinkPager extends \yii\widgets\LinkPager
{
    public $options = [
        'class' => 'pagination-block',
    ];
    
//    public $prevPageCssClass   = 'pagination-prev';
//    public $nextPageCssClass   = 'pagination-next';
    public $activePageCssClass = 'active';
    public $itemOptions        = ['class' => 'pagination-item'];

    public function init() {
        parent::init();
        $this->prevPageLabel = false;
        $this->nextPageLabel = false;
    }
}
