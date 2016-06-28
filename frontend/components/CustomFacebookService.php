<?php
namespace frontend\components;

use nodge\eauth\services\FacebookOAuth2Service;

class CustomFacebookService extends \nodge\eauth\services\extended\FacebookOAuth2Service {
    /**
     * https://developers.facebook.com/docs/authentication/permissions/
     */
//    protected $scope = 'email,user_birthday,user_hometown,user_location';
    /**
     * http://developers.facebook.com/docs/reference/api/user/
     *
     * @see FacebookOAuthService::fetchAttributes()
     */
    protected function fetchAttributes() {
        $this->attributes = (array)$this->makeSignedRequest('me', [
            'query' => [
                'fields' => join(',', [
                    'id',
                    'name',
                    'link',
                    'email',
                    'verified',
                    'first_name',
                    'last_name',
                    'gender',
                    'birthday',
                    'hometown',
                    'location',
                    'locale',
                    'timezone',
                    'updated_time',
                ])
            ]
        ]);
    }
}