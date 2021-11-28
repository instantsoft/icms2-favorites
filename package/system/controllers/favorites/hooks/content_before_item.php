<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesContentBeforeItem extends cmsAction {

    public function run($data){

        if(!$this->cms_user->is_logged){
            return $data;
        }

        list($ctype, $item, $fields) = $data;

        if(!isset($item['info_bar'])){ $item['info_bar'] = []; }

        $this->cms_template->addTplJSName('favorites');

        $is_in_favorites = $this->model->isInFavorites([
            'controller' => 'content',
            'subject_id' => $ctype['id'],
            'user_id'    => $this->cms_user->id,
            'item_id'    => $item['id']
        ]);

        if($is_in_favorites){
            $href = href_to($this->name, 'delete', ['content', $ctype['id'], $item['id']]);
        } else {
            $href = href_to($this->name, 'save', ['content', $ctype['id'], $item['id']]);
        }

        $item['info_bar']['favorites'] = [
            'css' => 'icms-favorites__btn'.($is_in_favorites ? ' text-success' : ''),
            'href' => $href,
            'html' => $is_in_favorites ? LANG_FAVORITES_SAVED : LANG_FAVORITES_ADD,
            'icon' => 'bookmark',
        ];

        return [$ctype, $item, $fields];
    }

}
