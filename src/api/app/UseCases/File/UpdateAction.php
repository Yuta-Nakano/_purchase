<?php

namespace App\UseCases\File;

use App\Models\File;
use Illuminate\Support\Facades\DB;

class UpdateAction
{
    public function __invoke(File $file): File
    {
        assert($file->exists);

        DB::beginTransaction();
        try {
            $file->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $file->refresh();
        return $file;
    }
}
