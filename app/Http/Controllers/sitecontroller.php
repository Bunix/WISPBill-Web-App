<?php

namespace App\Http\Controllers;

use App\Models\Settings;

use App\Models\Locations;

use App\Models\Site_Notes;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

class sitecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function create()
    {
        $api = Settings::where('setting_name', 'geocoder API key')->first();
        $lat = Settings::where('setting_name', 'map lat')->first();
        $lon = Settings::where('setting_name', 'map lon')->first();
        $zoom = Settings::where('setting_name', 'map zoom')->first();

        $lat = $lat['setting_value'];
        $lon = $lon['setting_value'];
        $zoom = $zoom['setting_value'];

        $mapsettings = array(
        "lat" => "$lat",
        "lon" => "$lon",
        "zoom" => "$zoom",
        );

        $key = $api['setting_value'];
        return view('site.new', compact('key','mapsettings'));
    }
    
    public function coverage()
    {
        $api = Settings::where('setting_name', 'geocoder API key')->first();
        $lat = Settings::where('setting_name', 'map lat')->first();
        $lon = Settings::where('setting_name', 'map lon')->first();
        $zoom = Settings::where('setting_name', 'map zoom')->first();

        $lat = $lat['setting_value'];
        $lon = $lon['setting_value'];
        $zoom = $zoom['setting_value'];

        $mapsettings = array(
        "lat" => "$lat",
        "lon" => "$lon",
        "zoom" => "$zoom",
        );

        $key = $api['setting_value'];
        
         $sites = Locations::all();
         
        return view('site.coverage', compact('key','mapsettings','sites'));
    }

        public function store(Request $request)
    {
         $this->validate($request, [
        'type' => 'required|in:micro,tower,other',
        'name' => 'required',
        'other' => 'required_if:type,other',
        'lon' => 'required',
        'lat' => 'required',
        ]);

         if($request['type'] == 'other'){
            $type = $request['other'];
         }else{
            $type = $request['type'];
         }
        Locations::create([
            'name' => $request['name'],
            'type' => $type,
            'longitude' => $request['lon'],
            'latitude' => $request['lat'],
            'coverage' => NULL,
        ]);

        return redirect("/");
    }
    
        public function storecoverage(Request $request)
    {
         $this->validate($request, [
        'data' => 'required',
        'site' => 'required',
        ]);

        
        Locations::where('id', $request['site'])->update(['coverage' => $request['data']]);

        return redirect("/");
    }
    
    public function map()
    {
        $api = Settings::where('setting_name', 'geocoder API key')->first();
        $lat = Settings::where('setting_name', 'map lat')->first();
        $lon = Settings::where('setting_name', 'map lon')->first();
        $zoom = Settings::where('setting_name', 'map zoom')->first();

        $lat = $lat['setting_value'];
        $lon = $lon['setting_value'];
        $zoom = $zoom['setting_value'];

        $mapsettings = array(
        "lat" => "$lat",
        "lon" => "$lon",
        "zoom" => "$zoom",
        );

        $key = $api['setting_value'];
        
        $sites = Locations::all();
        return view('site.map', compact('key','mapsettings','sites'));
    }
    
    public function index()
    {
        $total = Locations::count();
       
        $sites = Locations::with('contacts','notes.creator')->get();
        
        return view('site.view', compact('sites','total'));
    }
    
    public function notecreate()
    {
        
       $sites = Locations::all();
    
      return view('site.newnote', compact('sites'));
    }
    
    public function notestore(Request $request)
    {
         $this->validate($request, [
        'siteid' => 'required',
        'note' => 'required',
        ]);
        
        $userid = Auth::user()->id;
        
        Site_Notes::create([
            'location_id' => $request['siteid'],
            'user_id' => $userid,
            'note' => $request['note'],
        ]);

        return redirect("/");
    }
}
