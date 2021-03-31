<?php

namespace App\UseCases\File;

use App\Models\File;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(File $file, Filesystem $s3): File
    {
        assert(!$file->exists);

        DB::beginTransaction();
        try {
            $file->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $s3->delete($file->filename);
            abort(response(['message' => $e->getMessage()], 500));
        }

        $file->refresh();
        return $file;
    }
}
