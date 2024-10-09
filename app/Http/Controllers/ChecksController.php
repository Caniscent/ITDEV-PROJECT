<?php

namespace App\Http\Controllers;

use App\Models\ChecksModel;
use App\Models\ActivityModel;
use App\Models\TestMethodModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function calculatePersonalNeed($weight, $height, $age, $gender ,$bloodSugar, $testMethod, $activity) {
        $prediabetes = false;

        if ($testMethod == 'puasa') {
            if ($bloodSugar >= 100 && $bloodSugar <= 125) {
                $prediabetes = true;
            }
            else if ($bloodSugar > 125) {
                return [
                    "error" => True,
                    "code" => "DIABETES",
                ];
            }
        }
        else if ($testMethod == 'ttgo') {
            if ($bloodSugar >= 140 && $bloodSugar <= 199) {
                $prediabetes = true;
            }
            else if ($bloodSugar > 199) {
                return [
                    "error" => True,
                    "code" => "DIABETES",
                ];
            }
        }
        else {
            return [
                "error" => True,
                "code" => "INVALID_BLOOD_SUGAR_TEST",
            ];
        }

        if (!$prediabetes) {
            return [
                "error" => True,
                "code" => "NOT_PRE_DIABETES",
            ];
        }

        // Calculate BMI
        $body_level = [
            "underweight" => 18.5,
            "normal" => 24.9,
            "overweight" => 29.9,
            "obese" => 30,
        ];

        // Perhitungan BMI
        $bmi = round($weight / (($height / 100) ** 2), 2);

        foreach ($body_level as $category => $threshold ) {
            if ($bmi < $threshold) {
                $body = [$bmi,$category];
            }
            break;
        }

        if (!$body) {
            $body = [$bmi,'obese'];
        }

        // Calculate Daily Categories
        $cons = ($gender == 'perempuan') ? -161 : 5;
        $daily_calories = (10 * $weight) + (6.25 * $height) - (5 * $age) + $cons;

        $activity_level = [
            "very light" => 1.2,
            "light" => 1.375,
            "medium" => 1.55,
            "heavy" => 1.725,
        ];

        $daily_calories += $activity_level[$activity];

        $required_carb = round($daily_calories * 0.5  / 4, 2);
        $required_prot = round($daily_calories * 0.2  / 4, 2);
        $required_fat  = round($daily_calories * 0.2  / 9, 2);
        $required_fibr = round($daily_calories * 0.05 / 1, 2);

        $result = [
            "error" => False,
            "bmi" => $body[0],
            "bodyLevel" => $body[1],
            "dailyCal" => $daily_calories,
            "reqCarb" => $required_carb,
            "reqProt" => $required_prot,
            "reqFat" => $required_fat,
            "reqFibr" => $required_fibr,
        ];
        return var_dump($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = ActivityModel::all();
        $test_methods = TestMethodModel::all();
        return view('pages.check.create', compact('activities','test_methods'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:10|max:500',
            'sugar_content' => 'required|numeric',
            'activity' => 'required|exists:activity_categories,id',
            'test_method' => 'required|exists:test_method,id',
        ]);

        // mengambil data pengguna yang sedang login
        $user = Auth::user();

        // pastikan pengguna terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        // siapkan data untuk disimpan di tabel checks
        $data = [
            'user_id' => $user->id,
            'height' => $request->input('weight'),
            'weight' => $request->input('height'),
            'sugar_content' => $request->input('sugar_content'),
            'test_method_id' => $request->input('test_method'),
            'activity_categories_id' => $request->input('activity'),
        ];

        ChecksModel::create($data);

        // redirect ke halaman check.index
        return redirect()->route('check.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $check = ChecksModel::find($id);

        return view('pages.check.update', [
            'check' => $check
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'height_check' => 'required|numeric|min:50|max:300',
            'weight_check' => 'required|numeric|min:10|max:500',
        ], [
            'height_check.required' => 'Tinggi badan harus diisi.',
            'height_check.numeric' => 'Tinggi badan harus berupa angka.',
            'height_check.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height_check.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight_check.required' => 'Berat badan harus diisi.',
            'weight_check.numeric' => 'Berat badan harus berupa angka.',
            'weight_check.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight_check.max' => 'Berat badan tidak boleh melebihi 500 kg.',
        ]);

        $check = ChecksModel::find($id);

        $check->height_check = $request->input('height_check');
        $check->weight_check = $request->input('weight_check');

        $check->save();

        return redirect()->route('check.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = ChecksModel::find($id);

        if ($check != null) {
            $check->delete();
        }

        return redirect()->route('check.index');
    }
}
