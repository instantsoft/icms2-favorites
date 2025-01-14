<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesForumBeforeItem extends cmsAction {

    public function run($data){

        if(!$this->cms_user->is_logged || !$this->isShowInList('forum-'.favorites::DEFAULT_SUBJECT_ID)) {
            return $data;
        }

        list($category, $thread, $thread_poll, $posts, $form) = $data;

        if(!$posts) {
            return $data;
        }

        $this->cms_template->addTplJSName('favorites');

        $is_in_favorites = $this->model->isInFavoritesList([
            'controller' => 'forum',
            'subject_id' => favorites::DEFAULT_SUBJECT_ID,
            'user_id'    => $this->cms_user->id
        ], array_keys($posts));

        foreach ($posts as $id => $post) {

            if(!empty($is_in_favorites[$id])){
                $href = href_to($this->name, 'delete', ['forum', favorites::DEFAULT_SUBJECT_ID, $post['id']]);
            } else {
                $href = href_to($this->name, 'save', ['forum', favorites::DEFAULT_SUBJECT_ID, $post['id']]);
            }

            $posts[$id]['info_bar']['favorites'] = [
                'css' => 'icms-favorites__btn ml-3'.(!empty($is_in_favorites[$id]) ? ' text-success' : ''),
                'href' => $href,
                'title' => !empty($is_in_favorites[$id]) ? LANG_FAVORITES_SAVED : LANG_FAVORITES_ADD,
                'html' => '',
                'icon' => 'bookmark'
            ];
        }

        return [$category, $thread, $thread_poll, $posts, $form];
    }

}
