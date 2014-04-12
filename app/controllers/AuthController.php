<?php

/**
 * 
 *
 * @author Komov Roman
 */
class AuthController extends RESTfulController
{

    public function actionLogin()
    {
        $code = $this->request->getQuery('code');
        // Если код пришел
        if (!empty($code))
        {
            // Посылаем запрос на получение id пользователя
            $auth_info = $curl->
                    http('https://oauth.vk.com/access_token?client_id=4215000&client_secret=OwSxCeDhRDq4bJpn5uzq&code=' . $code . '&redirect_uri=http://huyznaet.ru/api/vk');
            $auth_info = json_decode($auth_info);
            // Посылаем запрос на получение данных пользователя
            $user_info = $curl->http('https://api.vk.com/method/users.get?user_ids=' .
                    $auth_info->user_id . '&fields=photo_100');
            $user_info = json_decode($user_info);
        }
    }
    