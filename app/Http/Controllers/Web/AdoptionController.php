<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionApplicationRequest;
use App\Models\AdoptionApplication;
use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdoptionController extends Controller
{
    /**
     * @var array $genders
     * @var array $ages
     */
    protected $genders;
    protected $ages;

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
    }
    /**
     * Create an adoption request for an animal.
     *
     * @param int $id The ID of the animal for adoption.
     *
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the success or failure of the adoption request.
     */
    public function adopt(AdoptionApplicationRequest $request, $id)
    {
        try {
            // Get the ID of the authenticated user
            $userId = Auth::guard('web')->user()->id;
            // Check if the adoption request already exists for the user and animal
            $check = AdoptionApplication::query()
                ->where('animal_id', $id)
                ->where('status', AdoptionApplication::PENDING)
                ->first();

            if ($check) {
                if ($check->user_id == $userId) {
                    return response()->json(['success' => false, 'message' => 'Your adoption request is duplicated']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Adoption requests are unavailable']);
                }
            }

            // Begin a database transaction
            DB::beginTransaction();

            $directoryIdCard = 'public/images/id_cards';
            if (!Storage::exists($directoryIdCard) ) {
                Storage::makeDirectory($directoryIdCard);
            }

            //Use the create and save image function below to get the path
            $frontSideIDcardPath = $this->saveIdCardImage($request->front_side_ID_card, $directoryIdCard);
            $backSideIDcardPath = $this->saveIdCardImage($request->back_side_ID_card, $directoryIdCard);

            // Define parameters for the adoption request
            $params = [
                'user_id' => $userId,
                'animal_id' => $id,
                'reason' => $request->reason,
                'front_side_ID_card' => $frontSideIDcardPath,
                'back_side_ID_card' => $backSideIDcardPath,
                'link_social' => $request->link_social,
                'application_date' => Carbon::now(),
                'status' => AdoptionApplication::PENDING
            ];

            // Create a new adoption application with the provided parameters
            $data = AdoptionApplication::create($params);
            // Commit the database transaction
            DB::commit();
            // Return a JSON response indicating a successful adoption request
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Adopt animal successfully'
            ]);
        } catch (\Exception $e) {
            // Log any error that occurs during the adoption request
            Log::error('[UserController][editProfile] error ' . $e->getMessage());
            // Roll back the database transaction in case of an error
            DB::rollBack();
            // Return a JSON response indicating a failed adoption request
            return response()->json(['success' => false, 'message' => 'Failed to adopt animal']);
        }
    }

    /**
     * Save the ID card image to the specified directory.
     *
     * @param \Illuminate\Http\UploadedFile $image The uploaded image file.
     * @param string $directory The directory to save the image in.
     *
     * @return string The path of the saved image.
     */
    private function saveIdCardImage($image, $directory)
    {
        // Generate a unique filename for the image using the current timestamp.
        $fileName = time() . '_' . $image->getClientOriginalName();

        // Save the image to the specified directory with the generated filename.
        $filePath = Storage::putFileAs($directory, $image, $fileName);

        // Return the path of the saved image, removing the 'public' prefix.
        return str_replace('public', '', $filePath);
    }
}
