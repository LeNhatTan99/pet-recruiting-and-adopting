<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnimalRequest;
use App\Models\Animal;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AnimalCasesController extends Controller
{
    /**
     * @var array $genders
     * @var array $ages
     */
    protected $genders;
    protected $ages;
    protected $breeds;
    protected $types;

    public function __construct(Animal $animal)
    {
        $this->genders = [
            Animal::MALE => 'Male',
            Animal::FEMALE => 'Female',
        ];
        $this->ages = [
            Animal::AGE_LESS_THAN_1 => 'Less than 1 years old',
            Animal::AGE_1_TO_2 => '1 to 2 years old',
            Animal::AGE_2_TO_5 => '2 to 5 years old',
            Animal::AGE_5_TO_10 => '5 to 10 years old',
            Animal::AGE_MORE_THAN_10 => 'More than 10 years old',
        ];
        $this->breeds = [
            Animal::BREED_NATIVE_DOG => 'Native Dog',
            Animal::BREED_NON_NATIVE_DOG => 'Non-native Dog',
            Animal::BREED_NATIVE_CAT => 'Native Cat',
            Animal::BREED_NON_NATIVE_CAT => 'Non-native Cat',
        ];
        $this->types = [
            Animal::TYPE_DOG => 'Dog',
            Animal::TYPE_CAT => 'Cat',
        ];
    }

    /**
     * Display a list of animals with their statuses and allow searching by name, type, or breed.
     *
     * @param Request $request The Request object containing user input, such as search criteria.
     *
     * @return \Illuminate\View\View Returns a view displaying a list of animals and their statuses.
     */
    public function index(Request $request)
    {
        // Get a list of animal statuses
        $status = Animal::getStatus();

        // Initialize a query builder for animals
        $datas = Animal::query();
        $datas->leftJoin('media', 'media.animal_id', '=', 'animals.id')
            ->select('animals.*',
                    DB::raw('JSON_ARRAYAGG(JSON_OBJECT("url", media.url, "type", media.type)) as media_info'))
            ->groupBy(
                'animals.id',
            );
        // Apply a search filter if a search term is provided
        if (isset($request->search)) {
            $searchTerm = $request->search;
            $datas->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('breed', 'like', '%' . $searchTerm . '%');
            });
        }

        // Paginate the result data with 10 records per page
        $datas = $datas->paginate(10);
        // Return a view with the list of animals and their statuses
        return view('admins.animals.index', compact('datas', 'status'));
    }


    /**
     * view create animal case
     * @return \Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        $status = Animal::getStatus();
        $genders = $this->genders;
        $breeds =  $this->breeds;
        $types =  $this->types;
        return view('admins.animals.create', compact('status', 'genders', 'types', 'breeds'));
    }

    /**
     * Store a new animal record and create an animal case.
     *
     * @param StoreAnimalRequest $request The Request object containing user input for creating a new animal.
     *
     * @return \Illuminate\Http\RedirectResponse Returns a redirection response with success or error messages.
     */
    public function store(StoreAnimalRequest $request)
    {
        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Get the ID of the rescuer (admin) creating the animal record
            $rescuerId = Auth::guard('admin')->user()->id;

            // Extract and validate input parameters for the animal record
            $params = $request->only([
                'name',
                'age',
                'type',
                'breed',
                'gender',
                'status',
                'description'
            ]);

            // Add the rescuer ID to the parameters
            $params['rescuer_id'] = $rescuerId;

            // Create a new animal record with the provided parameters
            $animal = Animal::create($params);
            
            // Create media
            $uploadedFiles = $request->file('media');
            if(!empty($uploadedFiles)) {
                //function create media file
                $this->createMedia($uploadedFiles, $animal->id);
            }
            // Commit the database transaction
            DB::commit();

            // Redirect to the create animal case page with a success message
            return redirect()->route('create.animal-case')->with(['success' => 'Create animal case successfully']);
        } catch (\Exception $e) {
            // Log any error that occurs during the animal creation
            Log::error('[AnimalCasesController][store] error ' . $e->getMessage());
            // Roll back the database transaction in case of an error
            DB::rollBack();
            // Redirect back with an error message
            return redirect()->back()->with(['error' => 'Failed to create animal case']);
        }
    }



    /**
     * view edit animal case
     * @return \Illuminate\Contracts\View\View|View
     */
    public function edit($id)
    {
        $data = Animal::find($id);
        $status = Animal::getStatus();
        $media = Media::where('animal_id', $id)->get();
        $genders = $this->genders;
        $breeds =  $this->breeds;
        $types =  $this->types;
        return view('admins.animals.edit', compact('data', 'status', 'genders', 'types', 'breeds', 'media'));
    }

    /**
     * store animal case
     * @param StoreAnimalRequest $request
     * @param $id
     * @return void
     */
    public function update(StoreAnimalRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = Animal::find($id);
            $params = $request->only([
                'name',
                'age',
                'type',
                'breed',
                'gender',
                'status',
                'description'
            ]);

            $uploadedFiles = $request->file('media');
            if(!empty($uploadedFiles)) {
                //function create media file
                $this->createMedia($uploadedFiles, $id);
            }
            //Check has delete media file when update
            $deletedMediaIds = $request->input('delete_media_ids');
            if(!empty($deletedMediaIds)) {
                $deletedMediaIdsArray = json_decode($deletedMediaIds, true);
                $mediaPaths = Media::whereIn('id', $deletedMediaIdsArray)->pluck('url')->toArray();

                // delete media file in storage
                foreach ($mediaPaths as $mediaPath) {
                    Storage::delete('public' . $mediaPath);
                }
                // delete media record in database
                Media::whereIn('id', $deletedMediaIdsArray)->delete();
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('edit.animal-case', $id)->with(['success' => 'Update animal case successfully']);
        } catch (\Exception $e) {
            Log::error('[AnimalCasesController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed to update animal case']);
        }
    }

    /**
     * show info animal
     * @param $id
     * @return void
     */
    public function show($id)
    {
        try {
            $animal = Animal::leftJoin('media', 'media.animal_id', '=', 'animals.id')
                ->select('animals.*', DB::raw('JSON_ARRAYAGG(JSON_OBJECT("url", media.url, "type", media.type)) as media_info'))
                ->where('animals.id', $id)
                ->groupBy('animals.id')
                ->first();
            return response()->json([
                'animal' => $animal,
                'success' => true,
                'message' => 'Show info successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('[AnimalCasesController][show] error ' . $e->getMessage());
            return response()->json(['error' => false, 'message' => 'Failed to show info']);
        }
    }

    /**
     * Update the status of an animal.
     *
     * @param Request $request The Request object containing user input, including the desired status.
     * @param int $id The ID of the animal whose status is to be updated.
     *
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the success or failure of the status update.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Find the animal by its ID
            $animal = Animal::find($id);

            // Begin a database transaction
            DB::beginTransaction();

            // Extract the 'status' parameter from the request and update the animal's status
            $params = $request->only([
                'status',
            ]);
            $data = $animal->update($params);

            // Commit the database transaction
            DB::commit();

            // Return a JSON response indicating a successful status update
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            // Log any error that occurs during the status update
            Log::error('[AnimalCasesController][updateStatus] error ' . $e->getMessage());

            // Roll back the database transaction in case of an error
            DB::rollBack();

            // Return a JSON response indicating a failed status update
            return response()->json(['error' => false, 'message' => 'Failed to update status']);
        }
    }

    public function createMedia($uploadedFiles, $animalId) {
        $directoryImages = 'public/images/animals';
        $directoryVideo = 'public/videos/animals';
        if (!Storage::exists($directoryImages) ) {
            Storage::makeDirectory($directoryImages);
        }
        if (!Storage::exists($directoryVideo) ) {
            Storage::makeDirectory($directoryVideo);
        }   
        foreach ($uploadedFiles as $key => $file) {
            $mimeType = $file->getMimeType();
            $mediaType = null;
            if (str_starts_with($mimeType, 'image/')) {
                $directory = $directoryImages;
                $mediaType = 'image';
            } elseif (str_starts_with($mimeType, 'video/')) {
                $directory = $directoryVideo;
                $mediaType = 'video';
            } else {
                continue;
            }       
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = Storage::putFileAs($directory, $file, $fileName);
            $newPath = str_replace('public', '', $filePath);
            Media::create([
                'animal_id' => $animalId,
                'url' => $newPath,
                'type' => $mediaType,
            ]);
        }  
    }
}
