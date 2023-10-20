<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * view index list adoption aplication
     * @return \Illuminate\Contracts\View\View|View
     */
    public function index(Request $request)
    {
        $datas = News::query();
        $datas->join('admins', 'forum_posts.user_id', '=', 'admins.id')
            ->select(
                'forum_posts.*',
                'admins.username',
                'admins.first_name',
                'admins.last_name',
                'admins.email',
                'admins.phone_number'
            )
            ->orderBy('created_at', 'desc');

        if (isset($request->search)) {
            $searchTerm = $request->search;
            $datas->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%');
            });
        }
        $datas = $datas->paginate(10);
        return view('admins.news.index', compact('datas'));
    }

    /**
     * show create news
     * @return \Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        return  view('admins.news.create');
    }
    /**
     * create post
     * @return \Illuminate\Contracts\View\View|View
     */
    public function store(StoreNewsRequest $request)
    {
        try {
            $userId = Auth::guard('admin')->user()->id;
            DB::beginTransaction();
            $params = [
                'user_id' => $userId,
                'title' => $request->title,
                'content' => $request->content,
                'post_date' => Carbon::now(),
            ];
            News::create($params);
            DB::commit();
            return redirect()->route('create.news')->with(['success' => 'Create new post successfully']);
        } catch (\Exception $e) {
            Log::error('[NewsController][create] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed to create post']);
        }
    }

    /**
     * show edit post
     * @return \Illuminate\Contracts\View\View|View
     */
    public function edit($id)
    {
        try {
            $data = News::findOrFail($id);
            return  view('admins.news.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error']);
        }
    }

    /**
     * Update a news post.
     *
     * @param StoreNewsRequest $request The request containing new post data.
     * @param int $id The ID of the news post to update.
     *
     * @return \Illuminate\Contracts\View\View|View Returns a view or redirects with a success message or error.
     */
    public function update(StoreNewsRequest $request, $id)
    {
        try {
            // Find the news post with the given ID
            $news = News::findOrFail($id);

            // Begin a database transaction
            DB::beginTransaction();

            // Define the parameters for the update
            $params = [
                'title' => $request->title,
                'content' => $request->content
            ];

            // Update the news post with the specified parameters
            $news->update($params);

            // Commit the database transaction
            DB::commit();

            // Redirect to the news index page with a success message
            return redirect()->route('admin.news')->with(['success' => 'Update post successfully']);
        } catch (\Exception $e) {
            // Log any error that occurs during the update
            Log::error('[NewsController][update] error ' . $e->getMessage());

            // Roll back the database transaction in case of an error
            DB::rollBack();

            // Redirect back with an error message
            return redirect()->back()->with(['error' => 'Failed to update post']);
        }
    }

    /**
     * delete news
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = News::find($id);
            $data->delete();
            DB::commit();
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Delete news successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('[newsController][Delete] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete news']);
        }
    }
}
