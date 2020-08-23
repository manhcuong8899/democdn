<?php

namespace VNPCMS\Images;

use Illuminate\Support\Facades\App;
use VNPCMS\Images\Images;
use VNPCMS\Images\Repository\ImagesRepositoryInterface;

class ImagesApplicationService
{

    /**
     * Create new Images
     *
     * @return array
     *
     * @return Articles
     **/
    public function create($article)
    {
        $imagesRepository = App::make(ImagesRepositoryInterface::class);
        $images = $imagesRepository->create($article);

        return $articles;
    }

    /**
     * Delete Images by ID
     *
     * @param key
     *
     * @return void
     **/
    public function delete($id)
    {
        $imagesRepository = App::make(ImagesRepositoryInterface::class);
        $imagesRepository->deleteByid($id);
    }

    /**
     * Update Images
     *
     * @param Images
     * @param array attributes
     *
     * @return void
     **/
    public function update(Images $id, array $attributes)
    {
        $imagesRepository = App::make(ImagesRepositoryInterface::class);
        $imagesRepository->update($id, $attributes);
    }

}