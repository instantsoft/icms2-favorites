<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesUserDelete extends cmsAction {

    public function run($user){

        $this->model->deleteUserFavorites($user['id']);

        return $user;
    }

}
