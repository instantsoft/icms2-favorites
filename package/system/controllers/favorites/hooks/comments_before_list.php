<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCommentsBeforeList extends cmsAction {

    const subject_id = 1;

    public function run($comments) {

        if(!$this->cms_user->is_logged || !$comments){
            return $comments;
        }

        $this->cms_template->addTplJSName('favorites');

        $is_in_favorites = $this->model->isInFavoritesList([
            'controller' => 'comments',
            'subject_id' => self::subject_id,
            'user_id'    => $this->cms_user->id
        ], array_keys($comments));

        foreach ($comments as $id => $post) {

            if(!empty($is_in_favorites[$id])){
                $href = href_to($this->name, 'delete', ['comments', self::subject_id, $post['id']]);
            } else {
                $href = href_to($this->name, 'save', ['comments', self::subject_id, $post['id']]);
            }

            $comments[$id]['actions'][] = [
                'class' => 'icms-favorites__btn'.(!empty($is_in_favorites[$id]) ? ' text-success' : ' btn-outline'),
                'href'  => $href,
                'hint'  => !empty($is_in_favorites[$id]) ? LANG_FAVORITES_SAVED : LANG_FAVORITES_ADD,
                'icon'  => 'bookmark'
            ];
        }

        return $comments;
    }

}
