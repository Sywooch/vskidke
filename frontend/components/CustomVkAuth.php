<?php

namespace frontend\components;

use common\models\User;
use nodge\eauth\services\VKontakteOAuth2Service;

/**
 * VKontakte provider class.
 *
 * @package application.extensions.eauth.services
 */
class CustomVkAuth extends VKontakteOAuth2Service {
    const SCOPE_FRIENDS = 'friends';
    const SCOPE_EMAIL = 'email';

    protected $name = 'vkontakte';
    protected $title = 'VK.com';
    protected $type = 'OAuth2';
    protected $jsArguments = array('popup' => array('width' => 500, 'height' => 450));

    protected $scopes = [self::SCOPE_EMAIL];
    protected $providerOptions = [
        'authorize' => 'http://api.vk.com/oauth/authorize',
        'access_token' => 'https://api.vk.com/oauth/access_token'
    ];
    protected $baseApiUrl = 'https://api.vk.com/method/';

    protected function fetchAttributes()
    {
        $tokenData = $this->getAccessTokenData(); 
        $info = $this->makeSignedRequest('users.get.json', array(
            'query' => array(
                'uids' => $tokenData['params']['user_id'],
                'fields' => 'email, sex, bdate, photo_big'
            )
        ));

        $info = $info['response'][0];

        $this->attributes['service'] = $this->getServiceName();
        $this->attributes['id'] = $info['uid'];
        $this->attributes['url'] = 'http://vk.com/id' . $info['uid'];
        $this->attributes['email'] = $tokenData['params']['email'];
        $this->attributes['status'] = User::STATUS_ACTIVE;

        $this->attributes['info'] = $info;

        return true;
    }
}