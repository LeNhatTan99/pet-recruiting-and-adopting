<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionApplication;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdoptionApplicationController extends Controller
{
    /**
     * Display a list of adoption applications along with their details.
     *
     * @param Request $request The Request object containing user input, such as search criteria.
     *
     * @return \Illuminate\View\View Returns a view displaying a list of adoption applications and their details.
     */
    public function index(Request $request)
    {
        // Get a list of adoption application statuses
        $status = AdoptionApplication::getStatus();

        // Initialize a query builder for adoption applications, joining with users and animals
        $datas = AdoptionApplication::query();
        $datas->join('users', 'adoption_applications.user_id', '=', 'users.id')
            ->join('animals', 'adoption_applications.animal_id', '=', 'animals.id')
            ->select(
                'adoption_applications.*',
                'users.username',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.phone_number',
                'users.address',
                'animals.name as animal_name'
            )
            ->orderBy('created_at', 'desc');

        // Apply a search filter if a search term is provided
        if (isset($request->search)) {
            $searchTerm = $request->search;
            $datas->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Paginate the result data with 15 records per page
        $datas = $datas->paginate(15);

        // Return a view with the list of adoption applications and their statuses
        return view('admins.adoptionApplication.index', compact('datas', 'status'));
    }



    /**
     * Update the status of an adoption application.
     *
     * @param Request $request The Request object containing user input, including the desired status.
     * @param int $id The ID of the adoption application to update.
     *
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the success or failure of the status update.
     */
    public function update(Request $request, $id)
    {
        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Find the adoption application by its ID
            $data = AdoptionApplication::find($id);

            // Find the associated animal
            $animal = Animal::find($data->animal_id);

            // Check if the animal is unavailable and the request status is 'ACCEPT'
            if ($animal->status == Animal::UNAVAILABLE && $request->status == AdoptionApplication::ACCEPT) {
                return response()->json(['success' => false, 'message' => 'Animal is not available']);
            }

            // Check if the animal is available and the request status is 'ACCEPT'
            if ($animal->status == Animal::AVAILABLE && $request->status == AdoptionApplication::ACCEPT) {
                $animal->update(['status' => Animal::UNAVAILABLE]);
            }

            // Check if the animal is unavailable and the current status of the application is 'ACCEPT'
            if ($animal->status == Animal::UNAVAILABLE && $data->status == AdoptionApplication::ACCEPT) {
                $animal->update(['status' => Animal::AVAILABLE]);
            }

            // Extract the 'status' parameter from the request and update the adoption application
            $params = $request->only([
                'status'
            ]);
            $data = $data->update($params);

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
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }
    }
}
