<?php
/*
namespace App\Http\Controllers;

use App\Models\Admin\Settings\Settings;
use App\Http\Request;
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Settings\SettingsRepositoryContract;
use App\Http\Requests\Admin\Settings\CreateSettingsRequest;
use App\Http\Requests\Admin\Settings\UpdateSettingsRequest;
use App\Repositories\Admin\Country\CountryRepositoryContract;
use App\Http\Requests;

use Session;


class SettingsController extends Controller
{
    protected $settings;
    protected $country;
    public function __construct(SettingsRepositoryContract $settings, CountryRepositoryContract $country)
    {
        $this->settings = $settings;
        $this->country = $country;
    }
    public function index()
    {
        return redirect()->route('admin.settings.create');
    }
    public function companySetting(CreateSettingsRequest $request)
    {
        
        $settings = $this->settings->findOrThrowException('1');
        return view('Admin.settings.create', ["settings"=>$settings])->withCountries($this->country->getAllCountry());
    }
    public function emailSetting(CreateSettingsRequest $request)
    {
        $settings = $this->settings->findOrThrowException('1');
        return view('Admin.settings.emailSetting', ["settings"=>$settings]);
    }
    public function systemSetting(CreateSettingsRequest $request)
    {
        $settings = $this->settings->findOrThrowException('1');
        return view('Admin.settings.systemSetting', ["settings"=>$settings]);
    }

    public function updateCompanySetting(UpdateSettingsRequest $request)
    {
        $this->settings->updateCompanySetting($request->all() );
        return redirect()->route('admin.settings.create')->with('success','Record updated successfully');
    }
    public function updateEmailSetting(UpdateSettingsRequest $request)
    {
        $this->settings->updateEmailSetting($request->all());
        return redirect()->route('admin.settings.emailSetting')->with('success','Record updated successfully');
    }
    public function updateSystemSetting(UpdateSettingsRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Logo');
            $image->move($destinationPath, $name);            
            $inputs['company_logo'] = $name;
        }else{
            $inputs['company_logo'] = $request->hidden_company_logo;
        }

        if ($request->hasFile('login_background')) {
            $image = $request->file('login_background');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Background');
            $image->move($destinationPath, $name);            
            $inputs['login_background'] = $name;
        }else{
            $inputs['login_background'] = $request->hidden_login_background;
        }
        
        $this->settings->updateSystemSetting($inputs);
        return redirect()->route('admin.settings.systemSetting')->with('success','Record updated successfully');
    }
    public function getStateByCountry($id)
    {
        $states = $this->settings->getStateByCountry($id);
        return response()->json(['success' => true, 'states' => $states]);
    }

}
