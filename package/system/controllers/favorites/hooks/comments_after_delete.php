<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCommentsAfterDelete extends cmsAction {

    public function run($comment){

        $this->model->deleteFavorite([
            'controller' => 'comments',
            'subject_id' => favorites::DEFAULT_SUBJECT_ID,
            'item_id'    => $comment['id']
        ]);

        return $comment;
    }

}
