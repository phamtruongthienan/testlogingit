<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use \Carbon\Carbon;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lang = \DB::table('config_language')->get();
        foreach ($lang as $k => $v) {
            if (File::exists(public_path() . '/sitemap_'.$v->code.'.xml')) {
                @unlink(public_path() . '/sitemap_'.$v->code.'.xml');
            }
            $sitemap = \App::make('sitemap');
            $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');
            $school = \DB::table('m_school_translation')
                    ->where('language_id', $v->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            foreach ($school as $k1 => $v1) {
                $sitemap->add(asset($v1->slug), $v1->created_at, '0.6', 'daily');
            }
            $sitemap->store('xml', 'sitemap_'.$v->code);
            if (File::exists(public_path() . '/sitemap_'.$v->code.'.xml')) {
                chmod(public_path() . '/sitemap_'.$v->code.'.xml', 0777);
            }
        }
    }
}
