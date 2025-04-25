<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employee::all();
       // Calculate salary for each employee based on attendance and formulas
       return view('admin.payroll.index', ['employees' => $employees]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
         // Fetch employees and dates from your data source
    $employees = Employee::all(); // Replace 'Employee' with your actual model class
    $today =today();
    $dates = [];

    for ($i = 1; $i <= $today->daysInMonth; ++$i) {
        $dates[] = $i;
    }
    
    return view('admin.payroll.create', compact('employees','dates'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // foreach ($request->employee_id as $index => $employeeId) {
        //     $data = [
        //         'employee_id' => $employeeId,
        //         'basic' => $request->basic[$index],
        //         'house_rent' => $request->house_rent[$index],
        //         'medical' => $request->medical[$index],
        //         'transport' => $request->transport[$index],
        //         'special' => $request->special[$index],
        //         'bonus' => $request->bonus[$index],
        //         'present' => $request->present[$index],
        //         'absent' => $request->absent[$index],
        //         'gross_salary' => $request->gross_salary[$index],
        //         'provident_fund' => $request->provident_fund[$index],
        //         'advanced' => $request->advanced[$index],
        //         'tax' => $request->tax[$index],
        //         'life_insurance' => $request->life_insurance[$index],
        //         'health_insurance' => $request->health_insurance[$index],
        //         'deduction' => $request->deduction[$index],
        //         'net_salary' => $request->net_salary[$index],
        //     ];
    
        //     // Create a new payroll entry
        //     Payroll::create($employees);
        // }
    
        // return redirect()->back()->with('success', 'Payroll data has been saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }

    public function grossSalary() {
        $employees = Employee::all();
        return view('admin.payroll.gross', compact('employees'));
    }

    public function calculatePayroll(Request $request) {
        if (isset($request->payroll)) {
            foreach ($request->payroll as $employeeId => $payrollData) {
                // Get the current year and month
                $currentYear = date('Y');
                $currentMonth = date('m');

                // Dynamically update or create payroll records
                Payroll::updateOrCreate(
                    [
                        'employee_id' => $employeeId,
                        'year' => $currentYear,
                        'month' => $currentMonth,
                    ],
                    [
                        'basic' => $payrollData['basic'],
                        'house_rent' => $payrollData['house_rent'],
                        // 'days_present' => $payrollData['days_present'],
                        // 'days_absent' => $payrollData['days_absent'],
                        'gross_salary' => $payrollData['gross_salary'],
                        'provident_fund' => $payrollData['provident_fund'],
                        'income_tax' => $payrollData['income_tax'],
                        'life_insurance' => $payrollData['life_insurance'],
                        'health_insurance' => $payrollData['health_insurance'],
                        'deduction' => $payrollData['deduction'],
                        'net_salary' => $payrollData['net_salary'],
                        'updated_at' => now(),
                    ]
                );
            }
        }
        return back();
    }

    public function sheetReport()
    {
        $employees = Employee::all();
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        return view('admin.payroll.report', compact('employees', 'months'));
    }

    public function generateReport(Request $request)
    {
        $selectedYear = $request->input('year') ? $year = 2025 : date('Y');
        // dd($selectedYear);
        $selectedMonth = $request->input('month');
        $employees = Employee::all();
        $salaryData = [];

        if ($selectedYear && $selectedMonth) {
            $salaryData = Payroll::whereIn('employee_id', $employees->pluck('id'))
                ->where('year', $selectedYear)
                ->where('month', $selectedMonth)
                ->orderBy('id', 'desc') // Ensure the latest record is fetched
                ->distinct('employee_id') // Ensure no duplicate employee records
                ->with('employee') // Load the employee relationship
                ->get();
        }

        // if ($selectedYear && $selectedMonth) {
        //     $salaryData = Payroll::whereYear('year', $selectedYear)
        //         ->whereMonth('month', $selectedMonth)
        //         ->with('employee') // Load the employee relationship
        //         ->get();
    
        //     return view('admin.payroll.report', compact('salaryData', 'selectedYear', 'selectedMonth'));
        // }
    
        // return view('admin.payroll.report');

        return view('admin.payroll.report', compact('employees', 'selectedYear', 'selectedMonth', 'salaryData'));
    }
}