<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesForumBeforeItem extends cmsAction {

    const post_subject_id = 1;

    public function run($data){

        if(!$this->cms_user->is_logged){
            return $data;
        }

        list($category, $thread, $thread_poll, $posts, $form) = $data;

        if($posts){

            $this->cms_template->addTplJSName('favorites');

            $is_in_favorites = $this->model->isInFavoritesList([
                'controller' => 'forum',
                'subject_id' => self::post_subject_id,
                'user_id'    => $this->cms_user->id
            ], array_keys($posts));

            foreach ($posts as $id => $post) {

                if(!empty($is_in_favorites[$id])){
                    $href = href_to($this->name, 'delete', ['forum', self::post_subject_id, $post['id']]);
                } else {
                    $href = href_to($this->name, 'save', ['forum', self::post_subject_id, $post['id']]);
                }

                $posts[$id]['info_bar']['favorites'] = [
                    'css' => 'icms-favorites__btn ml-3'.(!empty($is_in_favorites[$id]) ? ' text-success' : ''),
                    'href' => $href,
                    'title' => !empty($is_in_favorites[$id]) ? LANG_FAVORITES_SAVED : LANG_FAVORITES_ADD,
                    'html' => '',
                    'icon' => 'bookmark'
                ];
            }
        }

        return [$category, $thread, $thread_poll, $posts, $form];
    }

}
