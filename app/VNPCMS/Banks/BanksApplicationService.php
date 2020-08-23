<?php

namespace VNPCMS\Banks;

use Illuminate\Support\Facades\App;
use VNPCMS\Banks\Banks;
use VNPCMS\Banks\Repository\BanksRepositoryInterface;

class BanksApplicationService
{

    /**
     * Create new Banks
     *
     * @return array
     *
     * @return Articles
     **/
    public function create($article)
    {
        $BanksRepository = App::make(BanksRepositoryInterface::class);
        $Banks = $BanksRepository->create($article);

        return $articles;
    }

    /**
     * Delete Banks by ID
     *
     * @param key
     *
     * @return void
     **/
    public function delete($id)
    {
        $BanksRepository = App::make(BanksRepositoryInterface::class);
        $BanksRepository->deleteByid($id);
    }

    /**
     * Update Banks
     *
     * @param Banks
     * @param array attributes
     *
     * @return void
     **/
    public function update(Banks $id, array $attributes)
    {
        $BanksRepository = App::make(BanksRepositoryInterface::class);
        $BanksRepository->update($id, $attributes);
    }

}