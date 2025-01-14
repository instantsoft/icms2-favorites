<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCommentsAfterDeleteList extends cmsAction {

    public function run($comment_ids){

        foreach ($comment_ids as $comment_id) {
            $this->model->deleteFavorite([
                'controller' => 'comments',
                'subject_id' => favorites::DEFAULT_SUBJECT_ID,
                'item_id'    => $comment_id
            ]);
        }

        return $comment_ids;
    }

}
