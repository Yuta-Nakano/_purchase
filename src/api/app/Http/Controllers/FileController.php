<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreRequest;
use App\Http\Requests\File\UpdateRequest;
use App\Http\Resources\FileCollection;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\UseCases\File\StoreAction;
use App\UseCases\File\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(): FileCollection
    {
        $files = File::paginate();
        return new FileCollection($files);
    }

    public function store(StoreRequest $request, StoreAction $action): FileResource
    {
        $file = $request->makeFile();
        $file->filename = $file->slug . '.' . $request->file->extension();

        $s3 = Storage::disk('s3');
        $s3->putFileAs(
                '',
                $request->file,
                $file->filename,
                'public',
            );

        try {
            return new FileResource($action($file, $s3));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(File $file): FileResource
    {
        return new FileResource($file, 200);
    }

    public function update(UpdateRequest $request, File $file, UpdateAction $action): FileResource
    {
        $file = $request->fillFile($file);

        try {
            return new FileResource($action($file));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(File $file)
    {
        $s3 = Storage::disk('s3');

        DB::beginTransaction();
        try {
            $file->delete();
            $s3->delete($file->filename);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
