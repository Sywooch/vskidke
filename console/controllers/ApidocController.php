<?php

namespace console\controllers;

use Crada\Apidoc\Builder;
use Crada\Apidoc\Exception;
use yii\console\Controller;

class ApidocController extends Controller {
    public function actionIndex() {
        $classes = [
            'frontend\controllers\CityApiController',
            'frontend\controllers\CommentApiController',
            'frontend\controllers\DiscountApiController'
        ];

        $output_dir  = __DIR__.'/apidocs';
        $output_file = 'api.html'; // defaults to index.html

        try {
            $builder = new Builder($classes, $output_dir, 'Api Title', $output_file);
            $builder->generate();
        } catch (Exception $e) {
            echo 'There was an error generating the documentation: ', $e->getMessage();
        }
    }
}