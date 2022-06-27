<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $model = model(GameModel::class);
        $data = $model->getUserGames(1);
        $data = [
            'games' => $data
        ];
        return view('home/home.php', $data);
    }

    public function addGameImage($id, $image_path)
    {
        $model = model(GameModel::class);
        $model->updateGame($id, $image_path);

        return redirect()->to('/');
    }
}
