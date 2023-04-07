<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller{

    public function editShippingMethods($type){

        //Types => ("Free", "Inner", "Outer")
        if ($type === 'free'){
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        }elseif ($type === 'inner'){
            $shipping = Setting::where('key', 'local_label')->first();
        }elseif ($type === 'outer'){
            $shipping = Setting::where('key', 'outer_label')->first();
        }else{
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('dashboard.settings.shipping.edit', compact('shipping'));

    }

    public function updateShippingMethods(ShippingsRequest $request, $id){
        $setting = Setting::find($id);
        $setting->update($request->except('_token', 'id', 'method'));

        return view('dashboard.index');

    }

}
