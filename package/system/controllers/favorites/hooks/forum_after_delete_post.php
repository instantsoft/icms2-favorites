<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesForumAfterDeletePost extends cmsAction {

    public function run($post){

        $this->model->deleteFavorite([
            'controller' => 'forum',
            'subject_id' => favorites::DEFAULT_SUBJECT_ID,
            'item_id'    => $post['id']
        ]);

        return $post;
    }

}
