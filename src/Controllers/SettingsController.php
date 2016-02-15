<?php

namespace Code4\Platform\Controllers;

use App\Facades\Erp;
use Code4\Platform\Components\Settings\GeneralSettingsForm;
use Code4\Platform\Components\Settings\GeneralSettingsFormUser;
use Code4\Platform\Platform;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SettingsController extends Controller
{

    /**
     * General platform settings
     * @param Platform $platform
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function general(Platform $platform) {
        $form = new GeneralSettingsForm();
        $settings = $platform->settings('general');
        $action = action('\Code4\Platform\Controllers\SettingsController@store');
        $form->values($settings->all());

        return view('platform::settings.general', compact('form', 'action'));
    }

    /**
     * Store general platform settings
     * @param Request $request
     * @param Platform $platform
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Platform $platform) {
        //$block = 'general';
        $form = new GeneralSettingsForm();
        //$settings = $platform->settings($block);

        if (!$form->validate($request)) {
            return $form->response();
        }

        $values = $request->all();
        //Pola typu checkbox nie przesyłają danych jeśli są nie zaznaczone więc zaznaczamy brakujące:
        if (!array_key_exists('displayGravatar', $values)) {
            $values['displayGravatar'] = "0";
        }

        $platform->getSettingsFactory()->set('general.displayGravatar', $values['displayGravatar']);
        $platform->getSettingsFactory()->set('general.appName', $values['appName']);
        $platform->getSettingsFactory()->save();
        \Alert::success('Dane zapisane');
        return \PlatformResponse::checkNotifications()->makeResponse();
    }

    /**
     * General platform settings for user
     * @param Platform $platform
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generalUser(Platform $platform) {
        $form = new GeneralSettingsFormUser();
        $settings = $platform->settings('general_user');
        $form->values($settings->all());
        $action = action('\Code4\Platform\Controllers\SettingsController@storeGeneralUser');
        return view('platform::settings.general_user', compact('form', 'action'));
    }

    /**
     * Store general platform settings for user
     * @param Request $request
     * @param Platform $platform
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function storeGeneralUser(Request $request, Platform $platform) {
        $form = new GeneralSettingsFormUser();

        if (!$form->validate($request)) {
            return $form->response();
        }

        $values = $request->all();
        //Pola typu checkbox nie przesyłają danych jeśli są nie zaznaczone więc zaznaczamy brakujące:
        if (!array_key_exists('displayGravatar', $values)) {
            $values['displayGravatar'] = "0";
        }

        $platform->getSettingsFactory()->set('general_user.displayGravatar', $values['displayGravatar']);
        $platform->getSettingsFactory()->save();
        \Alert::success('Dane zapisane');
        return \PlatformResponse::checkNotifications()->makeResponse();
    }

}
