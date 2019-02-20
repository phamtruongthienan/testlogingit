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
use Validator;
use Hash;
use Socialite;
use Auth;
use Carbon\Carbon;
use App\Models\MSchool;
use App\Models\MCustomer;
use App\Models\MBooking;
use App\Models\MKeywordSearch;
use App\Charts\RegisterChart;
use App\Charts\BookingChart;
use Analytics;
use Spatie\Analytics\Period;
use \JordanMiguel\LaravelPopular\Traits\Visitable;

class Stat extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Visitable;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    //DEMO

    public function getDTStatView($time)
    {
        self::__construct();
       try {
            if(empty($time)) {
                $time = 'day';
            }
            if($time == 'day') {
                $data = MSchool::with('mSchoolTranslations')->popularDay();
             } else if($time == 'week') {
                 $data = MSchool::with('mSchoolTranslations')->popularWeek();
             } else if($time == 'month') {
                 $data = MSchool::with('mSchoolTranslations')->popularMonth();
             } else {
                 $data = MSchool::with('mSchoolTranslations')->PopularLast(365);
             }
            return Datatables::of($data)
                            ->editColumn('school', function ($v) {
                                return $v->mSchoolTranslations[0]->name;
                            })
                            ->editColumn('visits_count', function ($v) {
                                return $v->visits_count;
                            })
                            ->addIndexColumn()
                            ->make(true);
       } catch (\Exception $e) {
           return null;
       }
    }

    public function getDTStatKeyword()
    {
        self::__construct();
        try {
            $data = MKeywordSearch::select('id', 'keyword', DB::raw('count(*) as times'))->groupBy('keyword');
            return Datatables::of($data)
                            ->editColumn('keyword', function ($v) {
                                return $v->keyword;
                            })
                            ->editColumn('times', function ($v) {
                                return $v->times;
                            })
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getCount($type)
    {
        self::__construct();
        try {
            if($type == 1) {
                //CUSTOMER
                $data = MCustomer::count();
            } else if($type == 2) {
                //KEYWORD
                $data = MKeywordSearch::count();
            } else {
                // BOOKING
                $data = MBooking::count();
            }
            return number_format($data);
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getChart($type, $time)
    {
        self::__construct();
        try {
            $range = array();
            $range_name = array();
            if(empty($time)) {
                $time = 'day';
            }
            if($time == 'day') {
                $timestamp = strtotime('01:00:00');
                for ($i = 0; $i < 23; $i++) {
                    $range[] = strftime('%H', $timestamp);
                    $range_name[] = strftime('%H giờ', $timestamp);
                    $timestamp = strtotime('+1 hour', $timestamp);
                }
            } else if($time == 'week') {
                $timestamp = strtotime('monday this week');
                for ($i = 0; $i < 7; $i++) {
                    $range[] = strftime('%Y-%m-%d', $timestamp);
                    $range_name[] = strftime('%A', $timestamp);
                    $timestamp = strtotime('+1 day', $timestamp);
                }
            } else if($time == 'month') {
                $timestamp = strtotime('january this year');
                for ($i = 0; $i < 12; $i++) {
                    $range[] = strftime('%m', $timestamp);
                    $range_name[] = strftime('Tháng %m', $timestamp);
                    $timestamp = strtotime('+1 month', $timestamp);
                }
            } else {
                $timestamp = strtotime('now');
                for ($i = 0; $i < 3; $i++) {
                    $range[] = strftime('%Y', $timestamp);
                    $range_name[] = strftime('Năm %Y', $timestamp);
                    $timestamp = strtotime('-1 year', $timestamp);
                }
            }

            if($type == 1) {
                //CUSTOMER
                $data = [];
                $data_fb = [];
                $data_gg = [];
                foreach($range as $k => $v) {
                    switch($time) {
                        case "day":
                            $data[] =   MCustomer::whereBetween('created_at', [Carbon::now()->format('Y-m-d ').$v.':00:00', Carbon::now()->format('Y-m-d ').($v+1).':00:00'])->where('type', 1)->count();
                            $data_fb[] =   MCustomer::whereBetween('created_at', [Carbon::now()->format('Y-m-d ').$v.':00:00', Carbon::now()->format('Y-m-d ').($v+1).':00:00'])->where('type', 2)->count();
                            $data_gg[] =   MCustomer::whereBetween('created_at', [Carbon::now()->format('Y-m-d ').$v.':00:00', Carbon::now()->format('Y-m-d ').($v+1).':00:00'])->where('type', 3)->count();
                        break;

                        case "week":
                            $data[] =  MCustomer::whereDate('created_at', $v)->where('type', 1)->count();
                            $data_fb[] =  MCustomer::whereDate('created_at', $v)->where('type', 2)->count();
                            $data_gg[] =  MCustomer::whereDate('created_at', $v)->where('type', 3)->count();
                        break;

                        case "month":
                            $data[] =  MCustomer::whereYear('created_at', date('Y'))->whereMonth('created_at', $v)->where('type', 1)->count();
                            $data_fb[] =  MCustomer::whereYear('created_at', date('Y'))->whereMonth('created_at', $v)->where('type', 2)->count();
                            $data_gg[] =  MCustomer::whereYear('created_at', date('Y'))->whereMonth('created_at', $v)->where('type', 3)->count();
                        break;

                        case "year":
                            $data[] =  MCustomer::whereYear('created_at', $v)->where('type', 1)->count();
                            $data_fb[] =  MCustomer::whereYear('created_at', $v)->where('type', 2)->count();
                            $data_gg[] =  MCustomer::whereYear('created_at', $v)->where('type', 3)->count();
                        break;
                    }
                   
                }
                $chart = new RegisterChart;
                $chart->labels($range_name);
                $chart->width(0);
                $chart->dataset('Đăng ký thường', 'bar', $data)->backgroundColor('#0F9D58');
                $chart->dataset('Facebook', 'bar', $data_fb)->backgroundColor('#3b5998');
                $chart->dataset('Google', 'bar', $data_gg)->backgroundColor('#DB4437');
                return $chart;
            } else {
                // BOOKING
                $data = [];
                foreach($range as $k => $v) {
                    switch($time) {
                        case "day":
                            $data[] =   MBooking::whereBetween('created_at', [Carbon::now()->format('Y-m-d ').$v.':00:00', Carbon::now()->format('Y-m-d ').($v+1).':00:00'])->count();
                        break;

                        case "week":
                            $data[] =  MBooking::whereDate('created_at', $v)->count();
                        break;

                        case "month":
                            $data[] =  MBooking::whereYear('created_at', date('Y'))->whereMonth('created_at', $v)->count();
                        break;

                        case "year":
                            $data[] =  MBooking::whereYear('created_at', $v)->count();
                        break;
                    }
                   
                }
                $chart_booking = new BookingChart;
                $chart_booking->labels($range_name);
                $chart_booking->dataset('Khách hàng tham quan', 'bar', $data)->backgroundColor('#0F9D58');
                return $chart_booking;
            }
           
        } catch (\Exception $e) {
            return [0,0,0,0,0,0,0,0,0,0,0,0];
        }
    }
    //DEMO
}
