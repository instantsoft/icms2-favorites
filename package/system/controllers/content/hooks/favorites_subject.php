<?php

class onContentFavoritesSubject extends cmsAction {

    public $disallow_event_db_register = true;

    public function run($ctype_id, $page_url) {

        $ctype = $this->model->getContentType($ctype_id);
        if (!$ctype) {
            return '';
        }

        $this->model->join('favorites', 'fav', "fav.item_id = i.id AND fav.subject_id = '{$ctype['id']}' AND fav.controller = 'content'")->
                filterEqual('fav.user_id', $this->cms_user->id);

        return $this->setListContext('favorites')->renderItemsList($ctype, $page_url);
    }

}
