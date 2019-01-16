<?php

namespace App\Http\Controllers\Helper\Back;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use GuzzleHttp\Client;
use Validator;
use Hash;
use Socialite;
use Auth;
use Carbon\Carbon;
use App\Models\MMenu;
use App\Models\ConfigLanguage;
use App\Models\ConfigCity;
use App\Models\MSchool;
use App\Models\ConfigMain;
use App\Models\ConfigOther;
use App\Models\MSchoolEvent;
use App\Models\MClient;
use App\Models\MCustomer;
use App\Models\MNews;
use App\Models\MLayout;
use App\Models\MNewsTranslation;
use App\Models\MSubscribe;
use App\Models\MSchoolAttribute;
use App\Models\MAdvert;
use App\Models\MAdvertsTranslation;
use App\Models\MSchoolCategory;
use App\Models\MSchoolComment;
use App\Models\MSchoolCommentRating;
use App\Models\MSchoolType;
use App\Models\MSchoolLevel;
use App\Models\MSchoolLanguage;
use App\Models\MRating;
use App\Models\MWishlist;
use App\Models\MChild;
use App\Models\MSchoolTranslation;
use App\Models\MGenitive;

class Helper extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function DecodeImage($file) {
        $file_tmp = explode(';', $file);
        $file_tmp1 = explode(',', $file_tmp[1]);
        return base64_decode($file_tmp1[1]);
    }

    public function postLoginAdmin($request)
    {
        self::__construct();
        try {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'locked' => 0])) {
                return Auth::guard('admin')->user();
            } else {
                Auth::guard('admin')->logout();
                return null;
            }
        } catch (\Exception $e) {
            Auth::guard('admin')->logout();
            return null;
        }
    }
    
    public function getConfig()
    {
        self::__construct();
        try {
            $config = QueryBuilder::for(ConfigMain::class)
                ->allowedIncludes(
                    'config_maintranslations'
                )->get();
            if (!empty($config)) {
                return $config;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getConfigLanguage($lang = null)
    {
        self::__construct();
        try {
            $config = QueryBuilder::for(ConfigLanguage::class);
            if($lang != null) {
                if(is_numeric($lang)) {
                    $config = $config->where('id', $lang)->get();
                } else {
                    $config = $config->where('code', $lang)->get();
                }
            } else {
                $config = $config->where('id', $this->lang_id)->get();
            }   
            if (!empty($config)) {
                return $config;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }
}
