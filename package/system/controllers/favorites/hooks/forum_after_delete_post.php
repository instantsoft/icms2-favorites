<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesForumAfterDeletePost extends cmsAction {

    const post_subject_id = 1;

    public function run($post){

        $this->model->deleteFavorite([
            'controller' => 'forum',
            'subject_id' => self::post_subject_id,
            'item_id'    => $post['id']
        ]);

        return $post;
    }

}
