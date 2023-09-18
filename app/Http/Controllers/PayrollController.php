<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\User;
use App\Models\Lembur;
use App\Models\Izin;
use App\Models\Penggajian;
use DateTime;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('payroll');
    }

    public function data_payroll()
    {
        $penggajian = Penggajian::all(); // Mengambil semua data pengguna (penggajian)
        $user = User::all(); // Mengambil semua data pengguna (user)
        return view('data-payroll', compact('penggajian', 'user'));
    }

    public function approve($id) {
        Penggajian::find($id)->update(['status' => 1]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $dateString = $request['month'];
        [$year, $month] = explode("-", $dateString);

        $users = User::all();
        foreach ($users as $user) {
            // function penambah
            $intensif = $this->get_intensif($user);
            $overtime = $this->get_overtime($user, $month, $year); //return array
            $overtime_paid = $overtime["overtime_paid"]; //array[0]
            $penjabaran_total = $overtime["penjabaran_total"]; //array[1]

            //function pengurang
            $bpjs = $this->get_bpjs($user);
            $nwnp = $this->get_nwnp($user, $month, $year); //return array
            $nwnp_cost = $nwnp["nwnp"]; //array[0]
            $total_izin = $nwnp["total_izin"]; //array[1]


            $paid_amount = $user->basic_salary + $user->subsidi + $intensif + $overtime_paid - $nwnp_cost - $bpjs;

            $penggajian[] = array(
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_position' => $user->position,
                'user_status' => $user->status,
                'date' => $dateString,
                'paid_amount' => $paid_amount,
                'izin_duration' => $total_izin,
                'izin_charge' => $nwnp_cost,
                'overtime_duration' => $penjabaran_total,
                'overtime_paid' => $overtime_paid,
                'tunjangan' => $user->subsidi,
                'bpjs' => $bpjs,
                'intensif' => $intensif,
                'gaji_pokok' => $user->basic_salary
            );
        }
        // dd($penggajian);
        return response()->json($penggajian);
    }

    function get_intensif($user)
    {
        if ($user->status != 0) {
            return 0;
        }
        $join_date = new DateTime($user->date_join);
        $now = new DateTime();

        $masa_kerja = $join_date->diff($now)->y;

        $intensif_fix = 1000000;
        $intensif_add = 100000;
        $intensif = $intensif_fix + ($intensif_add * $masa_kerja);
        return $intensif;
    }

    function get_overtime($user, $month, $year)
    {

        /**Get upah perjam */
        if ($user->status == 2) { //status HL
            $upah_lembur = $user->basic_salary / 173;
        } else {  //status kontrak + tetap
            $upah_lembur = ($user->basic_salary + $user->subsidi) / 173;
        }
        $upah_lembur = round($upah_lembur, 2);

        /** Get lembur data */
        $lembur = Lembur::where('user_id', $user->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)->get();


        /**Get total lembur */
        $overtime_paid = 0;
        $penjabaran = 0;
        foreach ($lembur as $lembur) {
            $duration = $lembur->duration;
            $extra = 0;
            if ($duration >= 4) {
                $first_hour = 4;
                $extra = $duration - $first_hour;
                $duration = 4;
            }

            $penjabaran = $duration + ($extra * 2);
            $paid = $upah_lembur * $penjabaran;
            $overtime_paid += $paid;
        }
        $data = array(
            "overtime_paid" => $overtime_paid,
            "penjabaran_total" => $penjabaran
        );
        return $data;
    }

    function get_nwnp($user, $month, $year)
    {
        $izin_qty = 0;

        /** Get izin data */
        $izin = Izin::where('user_id', $user->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->selectRaw('SUM(duration) as duration, type')
            ->groupBy('user_id', 'type')
            ->first();

        if ($izin) {
            $izin_qty = $izin->duration;
            if ($izin_qty >= $user->cuti_count) {
                $izin_qty = $izin_qty - $user->cuti_count;
            } else if ($izin_qty < $user->cuti_count && $izin->type == 1) {
                $izin_qty = 0;
            }
        }

        $nwnp = $izin_qty * ($user->basic_salary / 30);
        $data = array(
            "nwnp" => round($nwnp, 2),
            "total_izin" => $izin_qty
        );
        return $data;
    }

    function get_bpjs($user)
    {
        if ($user->bpjs == 0) {
            return 0;
        }
        $bpjs = ($user->basic_salary + $user->subsidi) * 0.03;
        return $bpjs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->payroll);
        foreach ($data as $d) {
            $penggajian = new Penggajian;
            $penggajian->user_id = $d->user_id;
            $penggajian->date = $d->date;
            $penggajian->paid_amount = $d->paid_amount;
            $penggajian->work_paid = $d->gaji_pokok;
            $penggajian->izin_duration = $d->izin_duration;
            $penggajian->izin_charge = $d->izin_charge;
            $penggajian->overtime_duration = $d->overtime_duration;
            $penggajian->overtime_paid = $d->overtime_paid;
            $penggajian->tunjangan = $d->tunjangan;
            $penggajian->bpjs = $d->bpjs;
            $penggajian->intensif = $d->intensif;
            $penggajian->status = 0;
            $penggajian->save();
            // dd($penggajian);
        }
        // dd($data);
        return response()->json("Sukses");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
