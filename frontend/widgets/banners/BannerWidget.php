<?php
namespace frontend\widgets\banners;

use common\models\Banners;
use yii\bootstrap\Widget;

class BannerWidget extends Widget
{

    public function run(){
        $leftBanners  = Banners::find()->where(['position' => Banners::LEFT_BANNER])->limit(2)->all();
        $rightBanners = Banners::find()->where(['position' => Banners::RIGHT_BANNER])->limit(2)->all();

        return $this->render('index', [
            'leftBanners'  => $leftBanners,
            'rightBanners' => $rightBanners
        ]);
    }

}