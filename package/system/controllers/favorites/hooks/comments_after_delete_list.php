<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCommentsAfterDeleteList extends cmsAction {

    const subject_id = 1;

    public function run($comment_ids){

        foreach ($comment_ids as $comment_id) {
            $this->model->deleteFavorite([
                'controller' => 'comments',
                'subject_id' => self::subject_id,
                'item_id'    => $comment_id
            ]);
        }

        return $comment_ids;
    }

}
