<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnimalController extends Controller
{
     /**
     * @var array $genders
     * @var array $ages
     */
    protected $genders;
    protected $ages;
    protected $breeds;
    protected $types;

/**
 * Constructor method for initializing class properties.
 *
 * @param Animal $animal The Animal model instance used for data retrieval.
 */
public function __construct(Animal $animal) {
    // Initialize the genders array with gender constants and labels
    $this->genders = [
        Animal::MALE => 'Male',
        Animal::FEMALE => 'Female',
    ];
    
    // Initialize the ages array with age constants and labels
    $this->ages = [
        Animal::AGE_LESS_THAN_1 => 'Less than 1 years old',
        Animal::AGE_1_TO_2 => '1 to 2 years old',
        Animal::AGE_2_TO_5 => '2 to 5 years old',
        Animal::AGE_5_TO_10 => '5 to 10 years old',
        Animal::AGE_MORE_THAN_10 => 'More than 10 years old',
    ];
    
    // Initialize the breeds array with breed constants and labels
    $this->breeds = [
        Animal::BREED_NATIVE_DOG => 'Native Dog',
        Animal::BREED_NON_NATIVE_DOG => 'Non-native Dog',
        Animal::BREED_NATIVE_CAT => 'Native Cat',
        Animal::BREED_NON_NATIVE_CAT => 'Non-native Cat',
    ];
    
    // Initialize the types array with type constants and labels
    $this->types = [
        Animal::TYPE_DOG => 'Dog',
        Animal::TYPE_CAT => 'Cat',
    ];
}

  /**
 * Method to display a list of adoption or donation cases.
 *
 * @param Request $request The Request object containing user input.
 * @return \Illuminate\View\View Returns a view displaying a list of cases with filters and pagination.
 */
public function adoptionCases(Request $request) {
    // Get the current route name
    $routeName = \Route::currentRouteName();
    
    // Retrieve lists of genders, ages, breeds, and animal types from class properties.
    $genders = $this->genders;
    $ages = $this->ages;
    $breeds = $this->breeds;
    $types = $this->types;
    
    // Determine the type of case (adoption or donation)
    if ($routeName == 'donationCases') {
        $datas = Animal::query()->where('status', Animal::NEED_DONATE);
    } else {
        $datas = Animal::query()->where('status', Animal::AVAILABLE);
    }
    $datas->leftJoin('media', 'media.animal_id', '=', 'animals.id')
        ->select('animals.*',
                DB::raw('JSON_ARRAYAGG(JSON_OBJECT("url", media.url, "type", media.type)) as media_info'))
        ->groupBy(
            'animals.id',
        );
    // Apply filters based on user input
    if (isset($request->breed)) {
        $datas->where('breed', $request->input('breed'));
    }
    if (isset($request->type)) {
        $datas->where('type', $request->input('type'));
    }
    if (isset($request->name)) {
        $datas->where('name', 'like', '%' . $request->input('name') . '%');
    }
    if (isset($request->genders)) {
        $selectedGenders = $request->input('genders');
        $datas->whereIn('gender', $selectedGenders);
    }
    if (isset($request->ages)) {
        $selectedAges = $request->input('ages');
        $datas->whereIn('age', function($query) use ($selectedAges) {
            $query->select('age');
            foreach ($selectedAges as $age) {
                switch ($age) {
                    case Animal::AGE_LESS_THAN_1:
                        $query->orWhere('age', '<', 1);
                        break;
                    case Animal::AGE_1_TO_2:
                        $query->orWhereBetween('age', [1, 2]);
                        break;
                    case Animal::AGE_2_TO_5:
                        $query->orWhereBetween('age', [2, 5]);
                        break;
                    case Animal::AGE_5_TO_10:
                        $query->orWhereBetween('age', [5, 10]);
                        break;
                    case Animal::AGE_MORE_THAN_10:
                        $query->orWhere('age', '>', 10);
                        break;
                }
            }
        });
    }
    
    // Paginate the result data with 20 records per page
    $datas = $datas->paginate(20);
    
    // Return the corresponding view based on the case type (adoption or donation) with data and filters
    if ($routeName == 'donationCases') {
        return view('pages.donationCase.index', compact('datas', 'genders', 'ages', 'breeds', 'types'));
    } else {
        return view('pages.adoptionCase.index', compact('datas', 'genders', 'ages', 'breeds', 'types'));
    }
}

       /**
     * show info animal
     * @param $id
     * @return void
     */
    public function showAnimalCase($id)
    {
        try {
            $animal = Animal::leftJoin('media', 'media.animal_id', '=', 'animals.id')
                ->select('animals.*', DB::raw('JSON_ARRAYAGG(JSON_OBJECT("url", media.url, "type", media.type)) as media_info'))
                ->where('animals.id', $id)
                ->groupBy('animals.id')
                ->firstOrFail();
            return view('pages.adoptionCase.show', compact('animal'));
        } catch (\Exception $e) {
            Log::error('[AnimalCasesController][show] error ' . $e->getMessage());           
            abort(404, 'Animal not found');
            return response()->json(['success' => false, 'message' => 'Failed to show info animal case']);
        }
    }
}
