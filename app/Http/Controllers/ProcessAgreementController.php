<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessAgreement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProcessAgreementsExport;
use Barryvdh\DomPDF\Facade\Pdf;

use Spatie\Activitylog\Models\Activity;


include_once app_path('Districts.php');
class ProcessAgreementController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $userDistrict = $request->input('district', ''); // Default to empty string if not set
        $selectedYear = $request->input('year', ''); // Get the selected year from the request
        $searchTerm = $request->input('search'); // Get the search term from the request
        $selectedField = $request->input('field', ''); // Get the selected field from the request


        // Query process agreements
        $processAgreementsQuery = ProcessAgreement::query();

        // Allow super admins and admins to see all process agreements
        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            // No need to apply any filters for super admins and admins
            // Filter by user district if a specific district is selected
            if (!empty($userDistrict) && $userDistrict !== 'All Districts') {
                $processAgreementsQuery->whereHas('user', function ($query) use ($userDistrict) {
                    $query->where('district', $userDistrict);
                });
            }
        } else {
            // For regular users, only show their own process agreements
            $processAgreementsQuery->where('user_id', $user->id);
        }

        // Filter process agreements based on the selected year if provided
        if (!empty($selectedYear) && $selectedYear !== 'All Years') {
            $processAgreementsQuery->whereYear('created_at', $selectedYear);
        }

        // Filter process agreements based on the selected field if provided
        if (!empty($selectedField) && $selectedField !== 'All Fields') {
            $processAgreementsQuery->where('field', $selectedField);
        }

        // Apply search filter
        if (!empty($searchTerm)) {
            $processAgreementsQuery->where(function ($query) use ($searchTerm) {
                $query->where('id', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhereHas('user', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('name', 'LIKE', '%' . $searchTerm . '%')
                                ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
                                ->orWhere('district', 'LIKE', '%' . $searchTerm . '%'); // Include district search
                    })
                    ->orWhere('field', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('task', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('performance_indicator', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('contracted_target', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('first_quarter', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('second_quarter', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('third_quarter', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('fourth_quarter', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('total', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('percentage', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Get the filtered process agreements
        $processAgreements = $processAgreementsQuery->paginate(10); // Paginate with 10 items per page

        // Get all districts
        $districts = getAllDistricts();

        // Get distinct years with process agreements
        $years = ProcessAgreement::query()
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->pluck(\DB::raw('YEAR(created_at) as year'))
            ->toArray();

        // Define the possible categories (fields)
        $fields = [
            'Economic',
            'Social',
            'Poverty Alleviation',
            'Health and Nutrition',
            'Agriculture',
            'Environment',
            'Government Revenue',
            'Public Expenditure',
            'Other Data'
        ];

        // Pass process agreements, districts, userDistrict, selectedYear, and years to the view
        return view('process_agreements.index', compact('processAgreements', 'districts', 'userDistrict', 'selectedYear', 'years', 'selectedField', 'fields'));
    }



    public function create()
    {
        return view('process_agreements.create');
    }

    public function social()
    {
        return view('process_agreements.social');
    }

    public function poverty()
    {
        return view('process_agreements.poverty');
    }

    public function HealthandNutrition()
    {
        return view('process_agreements.Health-and-Nutrition');
    }

    public function agriculture()
    {
        return view('process_agreements.agriculture');
    }   

    public function environment()
    {
        return view('process_agreements.environment');
    }

    public function governmentRevenue()
    {
        return view('process_agreements.government-revenue');
    }

    public function publicExpenditure()
    {
        return view('process_agreements.public-expenditure');
    }

    public function otherDetails()
    {
        return view('process_agreements.other-details');
    }

    public function showNavigation()
    {
        return view('process_agreements.navigation');
    }


    public function store(Request $request)
    {
        $request->validate([
            'field' => 'required',
            'task' => 'required',
            'performance_indicator' => 'nullable|string',
            'contracted_target' => 'nullable|numeric',
            'first_quarter' => 'nullable|numeric',
            'second_quarter' => 'nullable|numeric',
            'third_quarter' => 'nullable|numeric',
            'fourth_quarter' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'percentage' => 'nullable|numeric', 
        ]);

        $processAgreement = new ProcessAgreement();
        
        // Assign the authenticated user's ID to the user_id field
        $processAgreement->user_id = Auth::id(); // Or you can also use auth()->id()

        // Assign other fields from the form request
        $processAgreement->field = $request->field;
        $processAgreement->task = $request->task;
        $processAgreement->performance_indicator = $request->performance_indicator;
        $processAgreement->contracted_target = $request->contracted_target;
        $processAgreement->first_quarter = $request->first_quarter;
        $processAgreement->second_quarter = $request->second_quarter;
        $processAgreement->third_quarter = $request->third_quarter;
        $processAgreement->fourth_quarter = $request->fourth_quarter;
        $processAgreement->total = $request->total;
        $processAgreement->percentage = $request->percentage;

        $processAgreement->save();

        $user = Auth::user(); // Get the authenticated user

        // Log the activity
        activity()->log("Process Agreement created by {$user->name}");

        return redirect()->route('process_agreements.index')->with('success', 'Process Agreement created successfully.');
    }

    public function show(ProcessAgreement $processAgreement)
    {   
        return view('process_agreements.show', compact('processAgreement'));
    }

    public function edit(ProcessAgreement $processAgreement)
    {
        return view('process_agreements.edit', compact('processAgreement'));
    }

    public function update(Request $request, ProcessAgreement $processAgreement)
    {
        $request->validate([
            'contracted_target' => 'nullable|numeric',
            'first_quarter' => 'nullable|numeric',
            'second_quarter' => 'nullable|numeric',
            'third_quarter' => 'nullable|numeric',
            'fourth_quarter' => 'nullable|numeric',
            // You can remove 'total' and 'percentage' from validation as they are not directly editable by the user.
        ]);

        // Calculate total
        $total = ($request->first_quarter ?? 0) + ($request->second_quarter ?? 0) + ($request->third_quarter ?? 0) + ($request->fourth_quarter ?? 0);

        // Calculate percentage
        $percentage = ($total / ($request->contracted_target ?? 1)) * 100; // Using ?? 1 to prevent division by zero

        // Update the specified fields along with total and percentage
        $processAgreement->update([
            'contracted_target' => $request->contracted_target,
            'first_quarter' => $request->first_quarter,
            'second_quarter' => $request->second_quarter,
            'third_quarter' => $request->third_quarter,
            'fourth_quarter' => $request->fourth_quarter,
            'total' => $total,
            'percentage' => $percentage,
        ]);

        $user = Auth::user(); // Get the authenticated user
        
        // Log the activity
        activity()->log("Process Agreement created by {$user->name}");

        return redirect()->route('process_agreements.index')
            ->with('success', 'Process Agreement updated successfully');
    }




    public function destroy(ProcessAgreement $processAgreement)
    {
        $processAgreement->delete();

        $user = Auth::user(); // Get the authenticated user

        // Log the activity
        activity()->log("Process Agreement deleted {$user->name}");

        return redirect()->route('process_agreements.index')
            ->with('success', 'Process Agreement deleted successfully');
    }

    public function updateFieldStatus(Request $request)
    {
        $fieldId = $request->input('field_id');
        $isChecked = $request->input('is_checked');

        // Logic to update the field status based on $isChecked

        // Return a response if needed
        return response()->json(['success' => true]);
    }

    public function getWorkplacesByDistrict($district)
    {
        // Fetch users with the specified district
        $users = User::where('district', $district)->get();

        // Extract unique workplaces from the users
        $workplaces = $users->pluck('workplace')->unique();

        // Return the unique workplaces as JSON response
        return response()->json($workplaces);
    }


    public function downloadCSV(Request $request)
    {
        $user = Auth::user();
        $fileName = 'process_agreements.csv';

        if (!$user->hasRole('super-admin') && !$user->hasRole('admin')) {
            $this->logActivity($user, 'downloaded CSV', $request->year, $request->district, $request->search, $request->field);
            return Excel::download(new ProcessAgreementsExport($request->year, $request->district, $request->search, $request->field, $user->id), $fileName);
        }

        $this->logActivity($user, 'downloaded CSV', $request->year, $request->district, $request->search, $request->field);
        return Excel::download(new ProcessAgreementsExport($request->year, $request->district, $request->search, $request->field), $fileName);
    }

    public function downloadExcel(Request $request)
    {
        $user = Auth::user();
        $fileName = 'process_agreements.xlsx';

        if (!$user->hasRole('super-admin') && !$user->hasRole('admin')) {
            $this->logActivity($user, 'downloaded Excel', $request->year, $request->district, $request->search, $request->field);
            return Excel::download(new ProcessAgreementsExport($request->year, $request->district, $request->search, $request->field, $user->id), $fileName);
        }

        $this->logActivity($user, 'downloaded Excel', $request->year, $request->district, $request->search, $request->field);
        return Excel::download(new ProcessAgreementsExport($request->year, $request->district, $request->search, $request->field), $fileName);
    }

    public function downloadPDF(Request $request)
    {
        $user = Auth::user();
        $fileName = 'process_agreements.pdf';

        if (!$user->hasRole('super-admin') && !$user->hasRole('admin')) {
            $this->logActivity($user, 'downloaded PDF', $request->year, $request->district, $request->search, $request->field);
            return Excel::download(new ProcessAgreementsExport($request->year, $request->district, $request->search, $request->field, $user->id), $fileName, \Maatwebsite\Excel\Excel::DOMPDF);
        }

        $this->logActivity($user, 'downloaded PDF', $request->year, $request->district, $request->search, $request->field);
        return Excel::download(new ProcessAgreementsExport($request->year, $request->district, $request->search, $request->field), $fileName, \Maatwebsite\Excel\Excel::DOMPDF);
    }

    private function logActivity($user, $action, $year, $district, $search = null, $field = null)
    {
        $description = "User {$user->name} {$action} for year: {$year}, district: {$district}, search: {$search}, field: {$field}";
        activity()
            ->causedBy($user)
            ->withProperties(['year' => $year, 'district' => $district, 'search' => $search, 'field' => $field])
            ->log($description);
    }


    private function getFilteredProcessAgreements(Request $request)
    {
        $user = auth()->user();
        $userDistrict = $request->input('district', '');
        $selectedYear = $request->input('year', '');

        $processAgreementsQuery = ProcessAgreement::query();

        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            if (!empty($userDistrict) && $userDistrict !== 'All Districts') {
                $processAgreementsQuery->whereHas('user', function ($query) use ($userDistrict) {
                    $query->where('district', $userDistrict);
                });
            }
        } else {
            $processAgreementsQuery->where('user_id', $user->id);
        }

        if (!empty($selectedYear) && $selectedYear !== 'All Years') {
            $processAgreementsQuery->whereYear('created_at', $selectedYear);
        }

        return $processAgreementsQuery->get();
    }

    public function deleteFiltered(Request $request)
    {
        $user = auth()->user();
        $userDistrict = $request->input('district', '');
        $selectedYear = $request->input('year', '');

        // Query process agreements based on filters
        $processAgreementsQuery = ProcessAgreement::query();

        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            if (!empty($userDistrict) && $userDistrict !== 'All Districts') {
                $processAgreementsQuery->whereHas('user', function ($query) use ($userDistrict) {
                    $query->where('district', $userDistrict);
                });
            }
        } else {
            $processAgreementsQuery->where('user_id', $user->id);
        }

        if (!empty($selectedYear) && $selectedYear !== 'All Years') {
            $processAgreementsQuery->whereYear('created_at', $selectedYear);
        }

        // Fetch the filtered process agreements
        $filteredProcessAgreements = $processAgreementsQuery->get();

        // Delete the filtered process agreements
        DB::transaction(function () use ($filteredProcessAgreements) {
            $filteredProcessAgreements->each->delete();
        });

        return redirect()->route('process_agreements.index')->with('success', 'Filtered data deleted successfully.');
    }
}
