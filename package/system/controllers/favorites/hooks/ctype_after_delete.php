<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCtypeAfterDelete extends cmsAction {

    public function run($ctype) {

        $this->model->deleteFavorite([
            'controller' => 'content',
            'subject_id' => $ctype['id']
        ]);

        return $ctype;
    }

}
