<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Models\Comission;
use App\Models\MarketingMateri;
use App\Models\Payment;
use App\Models\Referal;
use App\Models\TotalComission;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserInformation;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PagesController extends Controller
{
    public function dashboard_afiliator(DashboardChart $chart, Request $request)
    {
        // DOCUMENTATION SEO: https://github.com/artesaos/seotools
        SEOTools::setTitle('Dashboard');
        SEOTools::setDescription('This is my page dashboard');
        SEOTools::opengraph()->setUrl(url('/dashboard/afiliator'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $data['referal_access'] = DB::table('referals')
            ->join('referal_accesses', 'referals.id', '=', 'referal_accesses.referal_id')
            ->where('referals.user_id', Auth::user()->id)
            ->count();

        $data['referal_registered'] = DB::table('referals')
            ->join('registered_referals', 'referals.id', '=', 'registered_referals.referal_id')
            ->where('referals.user_id', Auth::user()->id)
            ->count();

        $data['total_comission'] = TotalComission::where('user_id', Auth::user()->id)
            ->first();

        $data['sales'] = Comission::where('user_id', Auth::user()->id)
            ->count();

        if ($data['total_comission']->total_balance > 0) {
            $data['payment'] = Payment::where('total_comission_id', $data['total_comission']->id)
                ->sum('balance_pay');
        } else {
            $data['payment'] = 0;
        }

        $from = $request->input('from'); // Get query parameter
        $to = $request->input('to'); // Get query parameter
        if ($from && $to) {
            session([
                'from' => $from,
                'to' => $to
            ]);
            $chart = $chart->build($from, $to);
        } else {
            session()->forget('from');
            session()->forget('to');
            $chart = $chart->build();
        }

        return view('pages.afiliator.index', compact('data', 'chart'));
    }

    public function dashboard_admin(DashboardChart $chart, Request $request)
    {
        SEOTools::setTitle('Dashboard');
        SEOTools::setDescription('This is my page dashboard');
        SEOTools::opengraph()->setUrl(url('/dashboard/admin'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $data['referal_access'] = DB::table('referals')
            ->join('referal_accesses', 'referals.id', '=', 'referal_accesses.referal_id')
            ->count();

        $data['referal_registered'] = DB::table('referals')
            ->join('registered_referals', 'referals.id', '=', 'registered_referals.referal_id')
            ->count();

        $data['comission'] = TotalComission::sum('total_balance');

        $data['sales'] = Comission::count();

        $data['payment'] = Payment::sum('balance_pay');

        $from = $request->input('from'); // Get query parameter
        $to = $request->input('to'); // Get query parameter
        if ($from && $to) {
            session([
                'from' => $from,
                'to' => $to
            ]);
            $chart = $chart->build($from, $to);
        } else {
            session()->forget('from');
            session()->forget('to');
            $chart = $chart->build();
        }

        return view('pages.admin.index', compact('data', 'chart'));
    }

    public function pengaturan()
    {
        SEOTools::setTitle('Pengaturan');
        SEOTools::setDescription('This is my page settings');
        SEOTools::opengraph()->setUrl(url('/dashboard/pengaturan'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $userInfo = UserInformation::where('user_id', Auth::user()->id)->first();

        return view('pages.profile-setting', compact('userInfo'));
    }

    public function referal()
    {
        SEOTools::setTitle('Referal');
        SEOTools::setDescription('This is my page referals');
        SEOTools::opengraph()->setUrl(url('/dashboard/referal'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $linkReferal = Referal::where('user_id', Auth::user()->id)->first();

        return view('pages.afiliator.referal', compact('linkReferal'));
    }

    public function marketing_materi()
    {
        SEOTools::setTitle('Materi');
        SEOTools::setDescription('This is my page materis');
        SEOTools::opengraph()->setUrl(url('/dashboard/marketing-materi'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $data = MarketingMateri::latest()->paginate(12);

        return view('pages.afiliator.materi', compact('data'));
    }

    public function riwayat_pembayaran(Request $request)
    {
        SEOTools::setTitle('Riwayat Pembayaran');
        SEOTools::setDescription('This is my page payment history');
        SEOTools::opengraph()->setUrl(url('/dashboard/riwayat-pembayaran'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $from = $request->input('from'); // Get query parameter
        $to = $request->input('to'); // Get query parameter

        if ($from && $to) {
            session([
                'from' => $from,
                'to' => $to
            ]);

            $data = Payment::with('total_comission')
                ->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                ->whereRelation('total_comission', 'user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            session()->forget('from');
            session()->forget('to');

            $data = Payment::with('total_comission')
                ->whereRelation('total_comission', 'user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('pages.afiliator.riwayat-pembayaran', compact('data'));
    }

    public function pembayaran(Request $request)
    {
        SEOTools::setTitle('Pembayaran');
        SEOTools::setDescription('This is my page payment');
        SEOTools::opengraph()->setUrl(url('/dashboard/pembayaran'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        if ($request->input('search')) {
            session()->put('search', $request->input('search'));

            $afiliators = User::role('afiliator')
                ->with('total_comission')
                ->where('name', 'like', '%' . $request->search . '%')
                ->whereRelation('total_comission', 'total_balance', '>', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            session()->forget('search');

            $afiliators = User::role('afiliator')
                ->with('total_comission')
                ->whereRelation('total_comission', 'total_balance', '>', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('pages.admin.pembayaran.index', compact('afiliators'));
    }

    public function afiliator(Request $request)
    {
        SEOTools::setTitle('Affiliator');
        SEOTools::setDescription('This is my affiliator list');
        SEOTools::opengraph()->setUrl(url('/dashboard/affiliator-list'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        if ($request->input('search')) {
            session()->put('search', $request->input('search'));

            $afiliators = User::query()
                ->role('afiliator')
                ->with('user_information')
                ->where('name', 'like', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            session()->forget('search');

            $afiliators = User::query()
                ->role('afiliator')
                ->with('user_information')
                ->where('name', 'like', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        // dd($afiliators->toArray());

        return view('pages.admin.afiliator.index', compact('afiliators'));
    }

    public function detail_pembayaran($id)
    {
        $user = User::with('user_information', 'total_comission')->find($id);

        SEOTools::setTitle($user->name);
        SEOTools::setDescription('This is my page payment detail');
        SEOTools::opengraph()->setUrl(url('/dashboard/detail-pembayaran/' . $user->id));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        return view('pages.admin.pembayaran.detail', compact('user'));
    }

    public function buat_materi()
    {
        SEOTools::setTitle('Materi');
        SEOTools::setDescription('This is my page materis create');
        SEOTools::opengraph()->setUrl(url('/dashboard/buat-materi'));
        SEOTools::opengraph()->addProperty('type', 'dashboard');
        SEOTools::jsonLd()->addImage(asset('assets/logo.png'));

        $data = MarketingMateri::latest()->paginate(12);

        return view('pages.admin.materi', compact('data'));
    }
}
