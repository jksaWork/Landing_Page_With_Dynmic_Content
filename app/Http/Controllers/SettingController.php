<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Settings;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.settings');
    }

    public function store(Request $request)
    {
        $ValidatedDated = $request->except('_token');
        if ($request->has('logo_ar')) {
            $request->logo_ar->store('public/uploads');
            $ValidatedDated['logo_en'] = $request->logo_ar->hashName();
        }

        if ($request->has('logo_en')) {
            $request->logo_en->store('public/uploads');
            $ValidatedDated['logo_ar'] = $request->logo_en->hashName();
        }
        if ($request->hasFile('fav_icon')) {
            $request->fav_icon->store('public/uploads');
            $ValidatedDated['fav_icon'] = $request->fav_icon->hashName();
        }

        setting($ValidatedDated)->save();
        // return $request;
        return Redirect()->back();
    }
}