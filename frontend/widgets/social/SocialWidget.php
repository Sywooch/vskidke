<?php

namespace frontend\widgets\social;

use nodge\eauth\Widget;

class SocialWidget extends Widget {
    public function run()
    {
        echo $this->render('index', [
            'id' => $this->getId(),
            'services' => $this->services,
            'action' => $this->action,
            'popup' => $this->popup,
            'assetBundle' => $this->assetBundle,
        ]);
    }
}