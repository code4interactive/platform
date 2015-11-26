<?php

namespace Code4\Platform\Controllers;

use App\Facades\Erp;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SettingsController extends Controller
{
    public function general($currentBlock) {
        $settings = \Platform::settings();
        $forms = $settings->prepareForm(false, [$currentBlock]);
        $blocksSettings = $settings->settingsBlockConfiguration();
        return view('platform::settings.general', compact('forms', 'blocksSettings','currentBlock'));
    }

    public function store(Request $request) {
        $settings = \Platform::settings();

        if (!$request->has('block') || !$settings->hasBlock($request->get('block'))) {
            throw new BadRequestHttpException();
        }

        $block = $request->get('block');
        $form = $settings->getForm($block, false);

        if (!$form->validate($request)) {
            return $form->response();
        }

        //Pola typu checkbox nie przesyłają danych jeśli są nie zaznaczone więc szukamy pól które nie zostały przesłane
        //i ustawiamy im wartość 0
        $fields = $request->all();
        foreach ($form->all() as $formField) {
            if ($formField->type() == 'checkbox' && $formField->value() == '1' && !array_key_exists($formField->name(), $fields)) {
                $fields[$formField->name()] = "0";
            }
        }
        var_dump($fields);
        unset($fields['block']);
        //$settings->setData($block, $fields);


    }

    public function user($block) {
        $settings = \Platform::settings();
        $forms = $settings->prepareForm(true, [$block]);
        $blocksSettings = $settings->blocksSettings();
        return view('platform::settings.general', compact('forms', 'blocksSettings'));
    }

}
