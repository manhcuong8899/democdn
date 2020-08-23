<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use VNPCMS\Setting\Setting;
use App\Http\Requests\UpdateGeneralSettingsRequest;
use VNPCMS\Setting\SettingApplicationService;
use VNPCMS\Setting\Repository\SettingRepositoryInterface;

class SettingsController extends Controller
{

    /**
     * Instance of VNPCMS\Setting\Repository\SettingRepositoryInterface
     *
     * @var Object
     */
    private $settingRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;

        $this->middleware('auth');
        $this->middleware('permission:config_management');
    }

    /**
     * Update an existing setting
     *
     * @param App\Http\Requests\UpdateGeneralSettingsRequest
     * @param menuId
     */
    public function updateGeneralSettings(UpdateGeneralSettingsRequest $request)
    {

        $settingApplicationService = new SettingApplicationService();
        $requestArray = $request->all();

        if (!array_key_exists( 'enable_registration' , $requestArray )) {
            $requestArray['enable_registration'] = '0';
        }

        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = "logo." . $file->getClientOriginalExtension();
            $path = 'public/images/logo/';
            $requestArray['images']=$name;
            $file->move($path, $name);
        }

        foreach ($requestArray as $key => $value) {
            if ($key != '_method' && $key != '_token' ) {
                $setting = $this->settingRepository->byKey($key);
                if (!is_null($setting)) {
                    $settingApplicationService->update($setting, ['value' => $value]);
                }
            }
        }

        Flash::success(trans('VNPCMS.messages.models.update.success', ['modelname' => trans('VNPCMS.models.settings')]));

        return back();
    }

    /**
     * Show general settings in /settings/general
     *
     * @return View;
     **/
    public function showGeneralSettingsForm()
    {
        $settings = $this->settingRepository->getAll()->lists('value', 'key')->toArray();

        return view('settings.general', compact('settings'));
    }

    public function showdataSettingsForm()
    {
        $settings = $this->settingRepository->getAll()->lists('value', 'key')->toArray();

        return view('settings.data', compact('settings'));
    }

}
