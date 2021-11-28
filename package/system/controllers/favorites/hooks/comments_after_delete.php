<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCommentsAfterDelete extends cmsAction {

    const subject_id = 1;

    public function run($comment){

        $this->model->deleteFavorite([
            'controller' => 'comments',
            'subject_id' => self::subject_id,
            'item_id'    => $comment['id']
        ]);

        return $comment;
    }

}
