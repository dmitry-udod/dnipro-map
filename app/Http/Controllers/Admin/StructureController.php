<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\JsonHelpers;
use App\Repositories\StructureRepository;
use App\Structure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StructureController extends BaseAdminController
{
    use JsonHelpers;

    public function __construct(StructureRepository $repository)
    {
        $this->model = Structure::class;
        $this->repository = $repository;
        parent::__construct();

        view()->share('structure', $this->repository);
    }

    /**
     * Upload a file
     *
     * @param Request $request
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $files = $request->allFiles();
        $names = [];
        $fileData = [];

        foreach ($files as $file) {
            /** @var $file UploadedFile */
            $ext = last(explode('.', $file->getClientOriginalName()));
            $names[] = $file->getClientOriginalName();
            $uniqFileName = md5(uniqid('uploads', true)) . '.' . $ext;
            $path = public_path('uploads/structures');

            try {
                $file->move($path, $uniqFileName);
            } catch (\Exception $e) {
                logger()->error('File Upload Error', [$e->getMessage(), $e->getFile(), $e->getLine()]);
                return $this->jsonError($e->getMessage(), 500);
            }
            $current = [
                'original_name' => $file->getClientOriginalName(),
                'name' => $uniqFileName,
                'created_at' => Carbon::now()->toDateTimeString(),
            ];
            $fileData[] = $current;
        }

        return $this->jsonData($fileData);
    }
}
