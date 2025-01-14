<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesCommentsBeforeList extends cmsAction {

    public function run($comments) {

        if(!$this->cms_user->is_logged || !$comments || !$this->isShowInList('comments-'.favorites::DEFAULT_SUBJECT_ID)){
            return $comments;
        }

        $this->cms_template->addTplJSName('favorites');

        $is_in_favorites = $this->model->isInFavoritesList([
            'controller' => 'comments',
            'subject_id' => favorites::DEFAULT_SUBJECT_ID,
            'user_id'    => $this->cms_user->id
        ], array_keys($comments));

        foreach ($comments as $id => $post) {

            if(!empty($is_in_favorites[$id])){
                $href = href_to($this->name, 'delete', ['comments', favorites::DEFAULT_SUBJECT_ID, $post['id']]);
            } else {
                $href = href_to($this->name, 'save', ['comments', favorites::DEFAULT_SUBJECT_ID, $post['id']]);
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
