<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesContentBeforeList extends cmsAction {

    public function run($data) {

        if (!$this->cms_user->is_logged) {
            return $data;
        }

        list($ctype, $items) = $data;

        if (!$items) { return $data; }

        $this->cms_template->addTplJSName('favorites');

        $is_in_favorites = $this->model->isInFavoritesList([
            'controller' => 'content',
            'subject_id' => $ctype['id'],
            'user_id'    => $this->cms_user->id
        ], array_keys($items));

        foreach ($items as $id => $item) {

            if (!isset($item['info_bar'])) {
                $item['info_bar'] = [];
            }

            if (!empty($is_in_favorites[$id])) {
                $href = href_to($this->name, 'delete', ['content', $ctype['id'], $item['id']]);
            } else {
                $href = href_to($this->name, 'save', ['content', $ctype['id'], $item['id']]);
            }

            $items[$id]['info_bar']['favorites'] = [
                'css'  => 'icms-favorites__btn' . (!empty($is_in_favorites[$id]) ? ' text-success' : ''),
                'href' => $href,
                'html' => !empty($is_in_favorites[$id]) ? LANG_FAVORITES_SAVED : LANG_FAVORITES_ADD,
                'icon' => 'bookmark',
            ];
        }

        return [$ctype, $items];
    }

}
